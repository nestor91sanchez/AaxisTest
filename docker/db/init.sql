-- CREATE USER axxisuser WITH PASSWORD 'aaxis2024';
-- -- Create a database
-- CREATE DATABASE aaxistest_db;
-- -- Grant all privileges on the database to the user
-- GRANT ALL PRIVILEGES ON DATABASE aaxistest_db TO axxisuser;


SET search_path TO public;
DROP EXTENSION IF EXISTS "uuid-ossp";
CREATE EXTENSION "uuid-ossp" SCHEMA public;