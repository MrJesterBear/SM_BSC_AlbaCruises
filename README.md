# SM_BSC_AlbaCruises
 Assessment for DWBA for BSc Computing

# Tech
- PHP
- HTML5
- Bootstrap
- CSS
- JavaScript

# Setup
To test this website, go to /.secrets/ to run the `21005729_Database_Final.sql` file. Once this has been achieved, your webserver's php.ini file needs to include this at the bottom of the file:

```ini
[21005729_AlbaCruises]
21005729_AlbaCruises.cfg.DB_HOST=<Your Database Host address>
21005729_AlbaCruises.cfg.DB_USER=<Your Database Username>
21005729_AlbaCruises.cfg.DB_PASS=<Your Database Password>
21005729_AlbaCruises.cfg.DB_NAME=21005729_AlbaCruises
```
This is due to the connection to the database being done through the get_cfg_var() method

## Webserver
For the webserver, the documentroot **must be set to the website folder** otherwise some functionality breaks.
```.conf
<DocumentRoot /*yourFilesystem*/SM_BSC_AlbaCruises/>
```
## Test Credentials
User Type | Email | Password

- Basic | jerald.davidson@hotmail.co.uk | jerald4life!
- Staff | rochele.whitty@albacruises.scot | cruisesAreKing#

## Test Data
The test data is based on the timetable for 2024 with dates from 13th May to 18th October. This is stored in the same `.sql` file for setup.

# Last Update
00:45 24/11/2025
