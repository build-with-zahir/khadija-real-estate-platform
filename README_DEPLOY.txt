Khadija Real Estate - Core PHP Deployment

1. Copy the khadija_real_estate folder into your PHP server root.
   Example for XAMPP:
   C:\xampp\htdocs\khadija_real_estate

2. Open includes/config.php and confirm these values:
   DB_HOST = localhost
   DB_USER = root
   DB_PASS =
   DB_NAME = khadija_real_estate

3. In phpMyAdmin, select the existing khadija_real_estate database and import setup.sql.
   The PHP app can also auto-create propertyimage on first load.

4. Make sure these folders are writable by PHP:
   uploads/
   uploads/projects/
   uploads/properties/
   uploads/general/

5. Public website:
   http://localhost/khadija_real_estate/

6. Admin panel:
   http://localhost/khadija_real_estate/admin/
   Login uses the existing admin table. Existing bcrypt, plain-text, and md5 passwords are supported.

7. Multi-image galleries:
   Project gallery saves rows in projectimage.
   Property gallery saves rows in propertyimage.
   Old property.GalleryImages comma/newline values are migrated automatically into propertyimage.
