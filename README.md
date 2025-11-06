# SM_BSC_AlbaCruises
 Assessment for DWBA for BSc Computing

# Tech
- PHP
- HTML5
- Bootstrap
- CSS
- JavaScript

# Setup
To test this website, go to /.secrets/ to run the setup.sql file. once this has been achieved, your php.ini file needs to include this at the bottom of the file:

```ini
[21005729_AlbaCruises]
21005729_AlbaCruises.cfg.DB_HOST=<Your Database Host address>
21005729_AlbaCruises.cfg.DB_USER=<Your Database Username>
21005729_AlbaCruises.cfg.DB_PASS=<Your Database Password>
21005729_AlbaCruises.cfg.DB_NAME=21005729_AlbaCruises
```
This is due to the connection to the database being done through the get_cfg_var() method

## Test Credentials
User Type | Email | Password

- Basic | jerald.davidson@hotmail.co.uk | jerald4life!
- Staff | rochele.whitty@albacruises.scot | cruisesAreKing#

# Test Dataset
For bookings, data is set for August 2026 (10th -> 16th) to cover most dates (modnay to sunday) based on the sample data timetable.

# Last Update
11:09 03/11/2025