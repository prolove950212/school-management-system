ALTER TABLE `Class` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `Class` ADD `combinePass` BOOLEAN NOT NULL DEFAULT FALSE AFTER `description`;
ALTER TABLE `Student` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `Student` ADD `fourthSubject` VARCHAR(255) NULL DEFAULT NULL AFTER `isActive`;