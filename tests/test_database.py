"""Tests for the database module."""

import os
import tempfile
from datetime import datetime
from unittest import mock

from src import database as db


def setup_test_db():
    """Set up a temporary database for testing."""
    tmp = tempfile.NamedTemporaryFile(suffix=".db", delete=False)
    tmp.close()
    return tmp.name


def test_add_and_get_upcoming():
    tmp_path = setup_test_db()
    with mock.patch.object(db, "DB_PATH", tmp_path):
        db.init_db()
        apt_id = db.add_appointment(123, "Test appointment", datetime(2026, 3, 1, 10, 0))
        assert apt_id is not None

        upcoming = db.get_upcoming(123)
        assert len(upcoming) == 1
        assert upcoming[0]["description"] == "Test appointment"
    os.unlink(tmp_path)


def test_get_pending_and_mark_notified():
    tmp_path = setup_test_db()
    with mock.patch.object(db, "DB_PATH", tmp_path):
        db.init_db()
        db.add_appointment(123, "Past appointment", datetime(2026, 1, 1, 10, 0))

        pending = db.get_pending_appointments(datetime(2026, 2, 25, 12, 0))
        assert len(pending) == 1

        db.mark_notified(pending[0]["id"])
        pending = db.get_pending_appointments(datetime(2026, 2, 25, 12, 0))
        assert len(pending) == 0
    os.unlink(tmp_path)


def test_delete_appointment():
    tmp_path = setup_test_db()
    with mock.patch.object(db, "DB_PATH", tmp_path):
        db.init_db()
        apt_id = db.add_appointment(123, "To delete", datetime(2026, 3, 1, 10, 0))

        assert db.delete_appointment(apt_id, 123) is True
        assert db.delete_appointment(apt_id, 123) is False

        upcoming = db.get_upcoming(123)
        assert len(upcoming) == 0
    os.unlink(tmp_path)


def test_different_chat_ids():
    tmp_path = setup_test_db()
    with mock.patch.object(db, "DB_PATH", tmp_path):
        db.init_db()
        db.add_appointment(100, "User A", datetime(2026, 3, 1, 10, 0))
        db.add_appointment(200, "User B", datetime(2026, 3, 1, 10, 0))

        assert len(db.get_upcoming(100)) == 1
        assert len(db.get_upcoming(200)) == 1
        assert db.get_upcoming(100)[0]["description"] == "User A"
    os.unlink(tmp_path)
