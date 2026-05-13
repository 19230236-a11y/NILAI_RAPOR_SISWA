-- Insert Programs
INSERT INTO programs (name, code, description, created_at, updated_at) VALUES
('Farmasi Klinis & Komunitas', 'FK', 'Program keahlian Farmasi Klinis dan Komunitas', NOW(), NOW()),
('Asisten Keperawatan & Caregiver', 'AK', 'Program keahlian Asisten Keperawatan dan Caregiver', NOW(), NOW()),
('Teknik Komputer & Jaringan', 'TKJ', 'Program keahlian Teknik Komputer dan Jaringan', NOW(), NOW()),
('Teknik Sepeda Motor', 'TSM', 'Program keahlian Teknik Sepeda Motor', NOW(), NOW()),
('Teknik Kendaraan Ringan', 'TKR', 'Program keahlian Teknik Kendaraan Ringan', NOW(), NOW());

-- Insert Classes per Program
-- Farmasi Klinis & Komunitas (program_id = 1)
INSERT INTO classes (name, program_id, created_at, updated_at) VALUES
('Farmasi Klinis & Komunitas 1', 1, NOW(), NOW()),
('Farmasi Klinis & Komunitas 2', 1, NOW(), NOW()),
('Farmasi Klinis & Komunitas 3', 1, NOW(), NOW());

-- Asisten Keperawatan & Caregiver (program_id = 2)
INSERT INTO classes (name, program_id, created_at, updated_at) VALUES
('Asisten Keperawatan & Caregiver 1', 2, NOW(), NOW()),
('Asisten Keperawatan & Caregiver 2', 2, NOW(), NOW()),
('Asisten Keperawatan & Caregiver 3', 2, NOW(), NOW());

-- Teknik Komputer & Jaringan (program_id = 3)
INSERT INTO classes (name, program_id, created_at, updated_at) VALUES
('Teknik Komputer & Jaringan 1', 3, NOW(), NOW()),
('Teknik Komputer & Jaringan 2', 3, NOW(), NOW()),
('Teknik Komputer & Jaringan 3', 3, NOW(), NOW());

-- Teknik Sepeda Motor (program_id = 4)
INSERT INTO classes (name, program_id, created_at, updated_at) VALUES
('Teknik Sepeda Motor 1', 4, NOW(), NOW()),
('Teknik Sepeda Motor 2', 4, NOW(), NOW()),
('Teknik Sepeda Motor 3', 4, NOW(), NOW());

-- Teknik Kendaraan Ringan (program_id = 5)
INSERT INTO classes (name, program_id, created_at, updated_at) VALUES
('Teknik Kendaraan Ringan 1', 5, NOW(), NOW()),
('Teknik Kendaraan Ringan 2', 5, NOW(), NOW()),
('Teknik Kendaraan Ringan 3', 5, NOW(), NOW());
