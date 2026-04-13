
CREATE DATABASE IF NOT EXISTS city_care_db;
USE city_care_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    specialty VARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    experience VARCHAR(50),
    rating DECIMAL(2,1)
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon VARCHAR(50)
);

INSERT INTO doctors (name, specialty, image_url, experience, rating) VALUES
('Dr. Sarah Johnson', 'Cardiologist', 'https://images.unsplash.com/photo-1559839734-2b71f1536780?auto=format&fit=crop&q=80&w=400', '15 Years', 4.9),
('Dr. Michael Chen', 'Neurologist', 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=400', '12 Years', 4.8),
('Dr. Emily Rodriguez', 'Pediatrician', 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&q=80&w=400', '10 Years', 4.9),
('Dr. David Kim', 'Orthopedic Surgeon', 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=400', '18 Years', 4.7),
('Dr. Lisa Thompson', 'Oncologist', 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?auto=format&fit=crop&q=80&w=400', '14 Years', 4.9),
('Dr. James Wilson', 'Dermatologist', 'https://images.unsplash.com/photo-1612531388260-6303b896c7c6?auto=format&fit=crop&q=80&w=400', '9 Years', 4.6);

INSERT INTO services (title, description, icon) VALUES
('Emergency Care', '24/7 rapid response medical assistance for critical conditions.', 'ambulance'),
('Cardiology', 'Comprehensive heart health diagnostics and advanced treatments.', 'heart'),
('Neurology', 'Expert care for brain, spine, and nervous system disorders.', 'brain'),
('Pediatrics', 'Specialized medical care for infants, children, and adolescents.', 'baby'),
('Orthopedics', 'Advanced treatment for bone, joint, and muscle conditions.', 'bone'),
('Oncology', 'Personalized cancer treatment plans and compassionate care.', 'microscope');
