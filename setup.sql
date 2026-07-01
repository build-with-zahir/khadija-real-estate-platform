-- Khadija Real Estate PHP conversion setup
-- Run this inside the existing khadija_real_estate database.

CREATE TABLE IF NOT EXISTS `propertyimage` (
  `Id` INT AUTO_INCREMENT PRIMARY KEY,
  `PropertyId` INT NOT NULL,
  `ImageUrl` VARCHAR(255) NOT NULL,
  `DisplayOrder` INT DEFAULT 0,
  `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX (`PropertyId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional if your existing property table is InnoDB and you want enforced cascades:
-- ALTER TABLE `propertyimage` ENGINE=InnoDB;
-- ALTER TABLE `property` ENGINE=InnoDB;
-- ALTER TABLE `propertyimage`
--   ADD CONSTRAINT `fk_propertyimage_property`
--   FOREIGN KEY (`PropertyId`) REFERENCES `property`(`Id`) ON DELETE CASCADE;

-- Old property.GalleryImages values are migrated automatically by the PHP app
-- through includes/functions.php -> ensure_propertyimage_schema().
