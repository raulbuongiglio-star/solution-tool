"""Tests for the appointment message parser."""

from datetime import datetime

from src.parser import parse_appointment

# Fixed "now" for deterministic tests: Wednesday 2026-02-25 12:00
NOW = datetime(2026, 2, 25, 12, 0)


def test_tomorrow_with_time():
    result = parse_appointment("Dentista domani alle 15:30", now=NOW)
    assert result is not None
    desc, dt = result
    assert desc == "Dentista"
    assert dt == datetime(2026, 2, 26, 15, 30)


def test_date_with_month_name():
    result = parse_appointment("Riunione il 25 marzo alle 10", now=NOW)
    assert result is not None
    desc, dt = result
    assert desc == "Riunione"
    assert dt == datetime(2026, 3, 25, 10, 0)


def test_date_slash_format():
    result = parse_appointment("Spesa il 3/4 alle 11", now=NOW)
    assert result is not None
    desc, dt = result
    assert desc == "Spesa"
    assert dt == datetime(2026, 4, 3, 11, 0)


def test_date_slash_with_year():
    result = parse_appointment("Pagare bolletta il 15/03/2026 alle 14:30", now=NOW)
    assert result is not None
    desc, dt = result
    assert "bolletta" in desc.lower() or "Pagare" in desc
    assert dt == datetime(2026, 3, 15, 14, 30)


def test_weekday():
    # 2026-02-25 is Wednesday, so Saturday is +3 days = Feb 28
    result = parse_appointment("Chiamare Mario sabato alle 9:00", now=NOW)
    assert result is not None
    desc, dt = result
    assert "Mario" in desc
    assert dt == datetime(2026, 2, 28, 9, 0)


def test_oggi():
    result = parse_appointment("Meeting oggi alle 18", now=NOW)
    assert result is not None
    desc, dt = result
    assert desc == "Meeting"
    assert dt == datetime(2026, 2, 25, 18, 0)


def test_ricordami_prefix():
    result = parse_appointment("Ricordami di comprare il latte domani alle 8", now=NOW)
    assert result is not None
    desc, dt = result
    assert "latte" in desc.lower()
    assert dt == datetime(2026, 2, 26, 8, 0)


def test_ore_keyword():
    result = parse_appointment("Palestra domani ore 7", now=NOW)
    assert result is not None
    desc, dt = result
    assert desc == "Palestra"
    assert dt == datetime(2026, 2, 26, 7, 0)


def test_no_time_returns_none():
    result = parse_appointment("Dentista domani", now=NOW)
    assert result is None


def test_no_date_returns_none():
    result = parse_appointment("Dentista alle 15", now=NOW)
    assert result is None


def test_past_date_rolls_to_next_year():
    # Jan 10 is in the past relative to NOW (Feb 25)
    result = parse_appointment("Festa il 10 gennaio alle 20", now=NOW)
    assert result is not None
    _, dt = result
    assert dt.year == 2027
