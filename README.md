# Percorso del Cavallo

Progetto scolastico sviluppato in PHP e MySQL.

L'obiettivo è muovere il cavallo su una scacchiera 8x8 utilizzando le normali mosse a "L" degli scacchi, evitando di passare due volte sulla stessa posizione.

## Tecnologie utilizzate

- PHP
- MySQL
- HTML
- CSS
- Sessioni PHP

## Funzionalità

- Scacchiera 8x8
- Posizione iniziale del cavallo in [0,0]
- Calcolo delle mosse valide
- Memorizzazione delle posizioni già visitate
- Impossibilità di tornare su una casella già utilizzata
- Reset della partita

## Configurazione

1. Importare `database.sql` in MySQL.
2. Copiare:

   `config.example.php`

   e rinominarlo:

   `config.php`

3. Inserire in `config.php` le proprie credenziali MySQL.

4. Avviare il progetto con PHP, ad esempio:

   ```bash
   php -S localhost:8000

5. Aprire nel browser:

http://localhost:8000

Note

Questo progetto è stato realizzato originariamente come progetto scolastico e successivamente ripristinato e corretto per renderlo nuovamente eseguibile con versioni moderne di PHP e MySQL.