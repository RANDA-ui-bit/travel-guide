CREATE DATABASE IF NOT EXISTS travel_guide CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travel_guide;

DROP TABLE IF EXISTS destinations;
CREATE TABLE destinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  country VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  image_url VARCHAR(500) NOT NULL,
  best_time VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

INSERT INTO destinations (name, country, description, image_url, best_time) VALUES
('Cairo', 'Egypt', 'Explore ancient pyramids, bustling bazaars, and the Nile river experience.', 'https://picsum.photos/id/1011/900/600', 'Oct - Apr'),
('Marrakesh', 'Morocco', 'A vibrant medina, traditional riads, and unforgettable street food and souks.', 'https://picsum.photos/id/1015/900/600', 'Mar - May'),
('Santorini', 'Greece', 'Iconic whitewashed villages, caldera views, and dramatic sunsets.', 'https://picsum.photos/id/1025/900/600', 'May - Sep'),
('Kyoto', 'Japan', 'Temples, gardens, seasonal festivals, and historic streets in Gion.', 'https://picsum.photos/id/1035/900/600', 'Mar - May'),
('Bali', 'Indonesia', 'Beaches, rice terraces, wellness retreats, and cultural ceremonies.', 'https://picsum.photos/id/1039/900/600', 'Apr - Oct'),
('Paris', 'France', 'Museums, cafés, river cruises, and timeless landmarks.', 'https://picsum.photos/id/1043/900/600', 'Apr - Jun'),
('Cape Town', 'South Africa', 'Table Mountain hikes, coastal drives, and vibrant food markets.', 'https://picsum.photos/id/1050/900/600', 'Nov - Mar'),
('Reykjavik', 'Iceland', 'Gateway to waterfalls, geysers, glaciers and Northern Lights adventures.', 'https://picsum.photos/id/1056/900/600', 'Sep - Mar'),
('New York City', 'USA', 'Skyscrapers, Broadway shows, diverse neighborhoods, and iconic parks.', 'https://picsum.photos/id/1062/900/600', 'Apr - Jun'),
('Rome', 'Italy', 'Ancient ruins, piazzas, world-class cuisine, and vibrant street life.', 'https://picsum.photos/id/1069/900/600', 'Apr - Jun'),
('Barcelona', 'Spain', 'Gaudí architecture, city beaches, and lively culture.', 'https://picsum.photos/id/1074/900/600', 'May - Jul'),
('Istanbul', 'Turkey', 'A city between two continents with rich history and incredible food.', 'https://picsum.photos/id/1080/900/600', 'Apr - Jun'),
('Dubai', 'UAE', 'Modern attractions, desert adventures, and luxury shopping.', 'https://picsum.photos/id/1084/900/600', 'Nov - Mar'),
('Rio de Janeiro', 'Brazil', 'Beaches, mountains, music, and scenic viewpoints.', 'https://picsum.photos/id/1081/900/600', 'Dec - Mar'),
('Sydney', 'Australia', 'Harbor views, coastal walks, and famous landmarks.', 'https://picsum.photos/id/1082/900/600', 'Sep - Nov');

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(180) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO messages (full_name, email, message) VALUES
('Sample Student', 'student@example.com', 'Hello! This is a sample message saved in the database.'),
('Amina Hassan', 'amina@example.com', 'Can you recommend the best travel season for Cairo?'),
('David Lee', 'david.lee@example.com', 'Great project! I would like to add more destinations via the dashboard.');
