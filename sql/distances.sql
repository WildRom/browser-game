CREATE TABLE IF NOT EXISTS distances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    port1_id INT NOT NULL,
    port2_id INT NOT NULL,
    distance INT NOT NULL
);

-- Insert distance data
INSERT INTO distances (port1_id, port2_id, distance) VALUES
(1, 2, 2), (2, 1, 2),   -- England to France
(1, 3, 4), (3, 1, 4),   -- England to Spain
(1, 4, 8), (4, 1, 8),   -- England to Italy
(1, 5, 10), (5, 1, 10), -- England to Greece
(1, 6, 12), (6, 1, 12), -- England to Turkey
(1, 7, 14), (7, 1, 14), -- England to Egypt
(1, 8, 20), (8, 1, 20), -- England to India
(1, 9, 24), (9, 1, 24), -- England to China
(1, 10, 26), (10, 1, 26), -- England to Japan

(2, 3, 3), (3, 2, 3),   -- France to Spain
(2, 4, 6), (4, 2, 6),   -- France to Italy
(2, 5, 8), (5, 2, 8),   -- France to Greece
(2, 6, 10), (6, 2, 10), -- France to Turkey
(2, 7, 12), (7, 2, 12), -- France to Egypt
(2, 8, 18), (8, 2, 18), -- France to India
(2, 9, 22), (9, 2, 22), -- France to China
(2, 10, 25), (10, 2, 25), -- France to Japan

(3, 4, 5), (4, 3, 5),   -- Spain to Italy
(3, 5, 7), (5, 3, 7),   -- Spain to Greece
(3, 6, 9), (6, 3, 9),   -- Spain to Turkey
(3, 7, 11), (7, 3, 11), -- Spain to Egypt
(3, 8, 17), (8, 3, 17), -- Spain to India
(3, 9, 21), (9, 3, 21), -- Spain to China
(3, 10, 24), (10, 3, 24), -- Spain to Japan

(4, 5, 3), (5, 4, 3),   -- Italy to Greece
(4, 6, 5), (6, 4, 5),   -- Italy to Turkey
(4, 7, 7), (7, 4, 7),   -- Italy to Egypt
(4, 8, 14), (8, 4, 14), -- Italy to India
(4, 9, 18), (9, 4, 18), -- Italy to China
(4, 10, 20), (10, 4, 20), -- Italy to Japan

(5, 6, 2), (6, 5, 2),   -- Greece to Turkey
(5, 7, 4), (7, 5, 4),   -- Greece to Egypt
(5, 8, 10), (8, 5, 10), -- Greece to India
(5, 9, 14), (9, 5, 14), -- Greece to China
(5, 10, 16), (10, 5, 16), -- Greece to Japan

(6, 7, 3), (7, 6, 3),   -- Turkey to Egypt
(6, 8, 9), (8, 6, 9),   -- Turkey to India
(6, 9, 13), (9, 6, 13), -- Turkey to China
(6, 10, 15), (10, 6, 15), -- Turkey to Japan

(7, 8, 8), (8, 7, 8),   -- Egypt to India
(7, 9, 12), (9, 7, 12), -- Egypt to China
(7, 10, 14), (10, 7, 14), -- Egypt to Japan

(8, 9, 4), (9, 8, 4),   -- India to China
(8, 10, 6), (10, 8, 6), -- India to Japan

(9, 10, 3), (10, 9, 3); -- China to Japan

