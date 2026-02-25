"""Entry point: python -m src"""

import asyncio
import logging
import os
import sys

from .bot import check_reminders, create_app
from .database import init_db

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(name)s: %(message)s",
)
logger = logging.getLogger(__name__)


def main():
    token = os.environ.get("TELEGRAM_BOT_TOKEN")
    if not token:
        print(
            "Errore: imposta la variabile d'ambiente TELEGRAM_BOT_TOKEN.\n"
            "Puoi creare un bot su Telegram parlando con @BotFather."
        )
        sys.exit(1)

    init_db()
    logger.info("Database inizializzato.")

    app = create_app(token)

    # Schedule the reminder checker as a background task
    loop = asyncio.new_event_loop()
    asyncio.set_event_loop(loop)

    async def run():
        async with app:
            await app.start()
            # Start the updater to receive messages
            await app.updater.start_polling()
            logger.info("Bot avviato! In ascolto per messaggi...")

            # Run reminder checker in background
            reminder_task = asyncio.create_task(check_reminders(app))

            # Wait until interrupted
            stop_event = asyncio.Event()
            try:
                await stop_event.wait()
            except asyncio.CancelledError:
                pass
            finally:
                reminder_task.cancel()
                await app.updater.stop()
                await app.stop()

    try:
        loop.run_until_complete(run())
    except KeyboardInterrupt:
        logger.info("Bot fermato.")


if __name__ == "__main__":
    main()
