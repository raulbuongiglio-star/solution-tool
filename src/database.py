"""Database module for storing and managing appointments."""

import sqlite3
from datetime import datetime
from pathlib import Path

DB_PATH = Path(__file__).parent.parent / "appointments.db"


def get_connection() -> sqlite3.Connection:
    conn = sqlite3.connect(str(DB_PATH))
    conn.row_factory = sqlite3.Row
    return conn


def init_db():
    """Create the appointments table if it doesn't exist."""
    conn = get_connection()
    conn.execute("""
        CREATE TABLE IF NOT EXISTS appointments (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            chat_id INTEGER NOT NULL,
            description TEXT NOT NULL,
            remind_at TEXT NOT NULL,
            created_at TEXT NOT NULL DEFAULT (datetime('now')),
            notified INTEGER NOT NULL DEFAULT 0
        )
    """)
    conn.execute("""
        CREATE INDEX IF NOT EXISTS idx_remind_at
        ON appointments (remind_at, notified)
    """)
    conn.commit()
    conn.close()


def add_appointment(chat_id: int, description: str, remind_at: datetime) -> int:
    """Add a new appointment and return its ID."""
    conn = get_connection()
    cursor = conn.execute(
        "INSERT INTO appointments (chat_id, description, remind_at) VALUES (?, ?, ?)",
        (chat_id, description, remind_at.strftime("%Y-%m-%d %H:%M")),
    )
    appointment_id = cursor.lastrowid
    conn.commit()
    conn.close()
    return appointment_id


def get_pending_appointments(now: datetime) -> list[dict]:
    """Get all appointments that should be notified now."""
    conn = get_connection()
    rows = conn.execute(
        "SELECT id, chat_id, description, remind_at FROM appointments "
        "WHERE notified = 0 AND remind_at <= ?",
        (now.strftime("%Y-%m-%d %H:%M"),),
    ).fetchall()
    conn.close()
    return [dict(r) for r in rows]


def mark_notified(appointment_id: int):
    """Mark an appointment as notified."""
    conn = get_connection()
    conn.execute(
        "UPDATE appointments SET notified = 1 WHERE id = ?",
        (appointment_id,),
    )
    conn.commit()
    conn.close()


def get_upcoming(chat_id: int) -> list[dict]:
    """Get all future, non-notified appointments for a chat."""
    conn = get_connection()
    rows = conn.execute(
        "SELECT id, description, remind_at FROM appointments "
        "WHERE chat_id = ? AND notified = 0 ORDER BY remind_at",
        (chat_id,),
    ).fetchall()
    conn.close()
    return [dict(r) for r in rows]


def delete_appointment(appointment_id: int, chat_id: int) -> bool:
    """Delete an appointment. Returns True if something was deleted."""
    conn = get_connection()
    cursor = conn.execute(
        "DELETE FROM appointments WHERE id = ? AND chat_id = ?",
        (appointment_id, chat_id),
    )
    deleted = cursor.rowcount > 0
    conn.commit()
    conn.close()
    return deleted
