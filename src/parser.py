"""Parse natural language appointment messages in Italian."""

import re
from datetime import datetime, timedelta

MONTHS_IT = {
    "gennaio": 1, "febbraio": 2, "marzo": 3, "aprile": 4,
    "maggio": 5, "giugno": 6, "luglio": 7, "agosto": 8,
    "settembre": 9, "ottobre": 10, "novembre": 11, "dicembre": 12,
    "gen": 1, "feb": 2, "mar": 3, "apr": 4,
    "mag": 5, "giu": 6, "lug": 7, "ago": 8,
    "set": 9, "ott": 10, "nov": 11, "dic": 12,
}

WEEKDAYS_IT = {
    "lunedi": 0, "lunedì": 0,
    "martedi": 1, "martedì": 1,
    "mercoledi": 2, "mercoledì": 2,
    "giovedi": 3, "giovedì": 3,
    "venerdi": 4, "venerdì": 4,
    "sabato": 5,
    "domenica": 6,
}

RELATIVE_DAYS = {
    "oggi": 0,
    "domani": 1,
    "dopodomani": 2,
}


def parse_appointment(text: str, now: datetime | None = None) -> tuple[str, datetime] | None:
    """Parse an Italian appointment message.

    Supports formats like:
      - "Dentista domani alle 15:30"
      - "Riunione il 25 marzo alle 10"
      - "Chiamare Mario il 3/4 alle 9:00"
      - "Spesa sabato alle 11"
      - "Ricordami di pagare bolletta il 15/03/2026 alle 14:30"
      - "Meeting 25/02 ore 16"

    Returns (description, remind_at) or None if parsing fails.
    """
    if now is None:
        now = datetime.now()

    text = text.strip()
    # Remove common prefixes
    text = re.sub(r"^(ricordami\s+di\s+|ricordami\s+|ricorda\s+di\s+|ricorda\s+)", "", text, flags=re.IGNORECASE)

    date_part = None
    time_part = None
    description = text

    # --- Extract time ---
    time_pattern = r"(?:alle|ore|at)\s+(\d{1,2})(?::(\d{2}))?"
    time_match = re.search(time_pattern, description, re.IGNORECASE)
    if time_match:
        hour = int(time_match.group(1))
        minute = int(time_match.group(2)) if time_match.group(2) else 0
        time_part = (hour, minute)
        description = description[:time_match.start()] + description[time_match.end():]

    # Also try bare HH:MM at end of string
    if time_part is None:
        bare_time = re.search(r"(\d{1,2}):(\d{2})\s*$", description)
        if bare_time:
            time_part = (int(bare_time.group(1)), int(bare_time.group(2)))
            description = description[:bare_time.start()] + description[bare_time.end():]

    if time_part is None:
        return None  # Time is required

    hour, minute = time_part
    if not (0 <= hour <= 23 and 0 <= minute <= 59):
        return None

    # --- Extract date ---
    # Common Italian prepositions before dates
    _date_prefix = r"(?:(?:del|il|al|entro\s+il|per\s+il)\s+)?"

    # Pattern: DD/MM/YYYY or DD/MM or DD-MM-YYYY or DD-MM
    date_num = re.search(
        rf"{_date_prefix}(\d{{1,2}})[/\-](\d{{1,2}})(?:[/\-](\d{{4}}))?(?:\b|$)",
        description, re.IGNORECASE,
    )
    if date_num:
        day = int(date_num.group(1))
        month = int(date_num.group(2))
        year = int(date_num.group(3)) if date_num.group(3) else now.year
        try:
            date_part = datetime(year, month, day, hour, minute)
            # If date is in the past this year, assume next year
            if date_part < now and not date_num.group(3):
                date_part = date_part.replace(year=now.year + 1)
        except ValueError:
            return None
        description = description[:date_num.start()] + description[date_num.end():]

    # Pattern: "il/del DD mese" (e.g., "il 25 marzo", "del 25 feb")
    if date_part is None:
        months_pattern = "|".join(MONTHS_IT.keys())
        date_text = re.search(
            rf"{_date_prefix}(\d{{1,2}})\s+({months_pattern})\b(?:\s+(\d{{4}}))?",
            description, re.IGNORECASE,
        )
        if date_text:
            day = int(date_text.group(1))
            month = MONTHS_IT[date_text.group(2).lower()]
            year = int(date_text.group(3)) if date_text.group(3) else now.year
            try:
                date_part = datetime(year, month, day, hour, minute)
                if date_part < now and not date_text.group(3):
                    date_part = date_part.replace(year=now.year + 1)
            except ValueError:
                return None
            description = description[:date_text.start()] + description[date_text.end():]

    # Pattern: relative days (oggi, domani, dopodomani)
    if date_part is None:
        for word, delta_days in RELATIVE_DAYS.items():
            match = re.search(rf"\b{word}\b", description, re.IGNORECASE)
            if match:
                target = now + timedelta(days=delta_days)
                date_part = target.replace(hour=hour, minute=minute, second=0, microsecond=0)
                description = description[:match.start()] + description[match.end():]
                break

    # Pattern: weekday names (lunedì, martedì, ...)
    if date_part is None:
        for weekday_name, weekday_num in WEEKDAYS_IT.items():
            match = re.search(rf"\b{weekday_name}\b", description, re.IGNORECASE)
            if match:
                days_ahead = weekday_num - now.weekday()
                if days_ahead <= 0:
                    days_ahead += 7
                target = now + timedelta(days=days_ahead)
                date_part = target.replace(hour=hour, minute=minute, second=0, microsecond=0)
                description = description[:match.start()] + description[match.end():]
                break

    if date_part is None:
        return None  # Date is required

    # Clean up description
    description = re.sub(r"\s+", " ", description).strip(" ,.-")
    if not description:
        description = "Promemoria"

    return description, date_part
