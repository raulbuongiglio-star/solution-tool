"""Telegram bot for appointment reminders."""

import asyncio
import logging
from datetime import datetime
from zoneinfo import ZoneInfo

ROME_TZ = ZoneInfo("Europe/Rome")

from telegram import Update
from telegram.ext import (
    Application,
    CommandHandler,
    ContextTypes,
    MessageHandler,
    filters,
)

from . import database as db
from .parser import parse_appointment

logger = logging.getLogger(__name__)


async def cmd_start(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await update.message.reply_text(
        "Ciao! Sono il tuo assistente per i promemoria.\n\n"
        "Mandami un messaggio con cosa devi ricordare, la data e l'ora, "
        "e ti avviserò al momento giusto!\n\n"
        "Esempi:\n"
        '  "Dentista domani alle 15:30"\n'
        '  "Riunione il 25 marzo alle 10"\n'
        '  "Chiamare Mario sabato alle 9:00"\n'
        '  "Spesa il 3/4 alle 11"\n\n'
        "Comandi:\n"
        "  /lista - Vedi i prossimi appuntamenti\n"
        "  /elimina <id> - Elimina un appuntamento\n"
        "  /help - Mostra questo messaggio"
    )


async def cmd_help(update: Update, context: ContextTypes.DEFAULT_TYPE):
    await cmd_start(update, context)


async def cmd_lista(update: Update, context: ContextTypes.DEFAULT_TYPE):
    appointments = db.get_upcoming(update.effective_chat.id)
    if not appointments:
        await update.message.reply_text("Non hai appuntamenti in programma.")
        return

    lines = ["I tuoi prossimi appuntamenti:\n"]
    for apt in appointments:
        dt = datetime.strptime(apt["remind_at"], "%Y-%m-%d %H:%M")
        lines.append(
            f"  [{apt['id']}] {apt['description']}\n"
            f"       {dt.strftime('%d/%m/%Y alle %H:%M')}"
        )
    await update.message.reply_text("\n".join(lines))


async def cmd_elimina(update: Update, context: ContextTypes.DEFAULT_TYPE):
    if not context.args:
        await update.message.reply_text("Uso: /elimina <id>\nUsa /lista per vedere gli ID.")
        return

    try:
        apt_id = int(context.args[0])
    except ValueError:
        await update.message.reply_text("L'ID deve essere un numero. Usa /lista per vedere gli ID.")
        return

    if db.delete_appointment(apt_id, update.effective_chat.id):
        await update.message.reply_text(f"Appuntamento #{apt_id} eliminato.")
    else:
        await update.message.reply_text(f"Appuntamento #{apt_id} non trovato.")


async def handle_message(update: Update, context: ContextTypes.DEFAULT_TYPE):
    text = update.message.text
    if not text:
        return

    result = parse_appointment(text)
    if result is None:
        await update.message.reply_text(
            "Non ho capito. Mandami un messaggio con descrizione, data e ora.\n\n"
            "Esempi:\n"
            '  "Dentista domani alle 15:30"\n'
            '  "Riunione il 25 marzo alle 10"\n'
            '  "Chiamare Mario il 3/4 alle 9:00"'
        )
        return

    description, remind_at = result
    apt_id = db.add_appointment(update.effective_chat.id, description, remind_at)

    await update.message.reply_text(
        f"Appuntamento salvato! (#{apt_id})\n\n"
        f"  {description}\n"
        f"  {remind_at.strftime('%d/%m/%Y alle %H:%M')}\n\n"
        "Ti manderò un promemoria a quell'ora."
    )


async def check_reminders(app: Application):
    """Periodically check for appointments to notify."""
    while True:
        try:
            now = datetime.now(ROME_TZ).replace(tzinfo=None)
            pending = db.get_pending_appointments(now)
            for apt in pending:
                try:
                    await app.bot.send_message(
                        chat_id=apt["chat_id"],
                        text=(
                            f"PROMEMORIA!\n\n"
                            f"  {apt['description']}\n"
                            f"  Orario: {apt['remind_at']}"
                        ),
                    )
                    db.mark_notified(apt["id"])
                    logger.info("Notified appointment #%d", apt["id"])
                except Exception:
                    logger.exception("Failed to notify appointment #%d", apt["id"])
        except Exception:
            logger.exception("Error in reminder check loop")

        await asyncio.sleep(30)  # Check every 30 seconds


def create_app(token: str) -> Application:
    """Build and return the Telegram Application."""
    app = Application.builder().token(token).build()

    app.add_handler(CommandHandler("start", cmd_start))
    app.add_handler(CommandHandler("help", cmd_help))
    app.add_handler(CommandHandler("lista", cmd_lista))
    app.add_handler(CommandHandler("elimina", cmd_elimina))
    app.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND, handle_message))

    return app
