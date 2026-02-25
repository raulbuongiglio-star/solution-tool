# Appointment Reminder Bot (Telegram)

Bot Telegram per promemoria appuntamenti. Inviagli un messaggio con descrizione, data e ora e ti avviserà al momento giusto.

## Setup

### 1. Crea il bot Telegram

1. Apri Telegram e cerca **@BotFather**
2. Invia `/newbot` e segui le istruzioni
3. Copia il token che ti viene dato

### 2. Installa le dipendenze

```bash
pip install -r requirements.txt
```

### 3. Configura il token

```bash
export TELEGRAM_BOT_TOKEN="il-tuo-token"
```

### 4. Avvia il bot

```bash
python -m src
```

## Utilizzo

Scrivi al bot su Telegram con messaggi come:

| Messaggio | Cosa fa |
|---|---|
| `Dentista domani alle 15:30` | Promemoria domani alle 15:30 |
| `Riunione il 25 marzo alle 10` | Promemoria il 25 marzo alle 10:00 |
| `Chiamare Mario sabato alle 9:00` | Promemoria sabato prossimo alle 9:00 |
| `Spesa il 3/4 alle 11` | Promemoria il 3 aprile alle 11:00 |
| `Ricordami di pagare bolletta il 15/03/2026 alle 14:30` | Promemoria con data esatta |

### Comandi

- `/start` - Messaggio di benvenuto
- `/lista` - Mostra tutti gli appuntamenti futuri
- `/elimina <id>` - Elimina un appuntamento
- `/help` - Mostra l'aiuto

## Come funziona

- Il bot analizza i messaggi in italiano estraendo descrizione, data e ora
- Gli appuntamenti vengono salvati in un database SQLite locale
- Ogni 30 secondi il bot controlla se ci sono promemoria da inviare
- Quando arriva il momento, ti invia un messaggio di notifica
