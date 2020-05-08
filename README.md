# Production Setup
## Virtual Environments for Both Tests
1. Bring up all the containers: `docker-compose up --build -d`

## Programming Test Stack
1. Migrate backend DB: `docker-compose exec programming-backend bin/cake migrations migrate`
2. Browse to `http://localhost` in your browser and click the `START` button

### NOTE
- Frontend starts at port `80`, backend start at port `8080`
- The frontend will connect to the backend at the url `http://localhost:8080`, config can be changed at `docker-compose.yml`
- Backend port can be changed at `docker-compose.yml`

## SQL Improvement Test Environment
1. Enter virtual environment: `docker-compose exec sql-improvement mysql -uroot`
2. Run SQL setup script: `source /mysql/setup.sql; use sql_improvement;`
3. Run the improvement: `source /mysql/benchmarks/improved.sql`

### NOTE
- Answer and explanation in `B-SQL_Improvement/README.md`.
- Sometimes you might get the error `ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)`, this is because the server is still starting up, just wait a few more minutes and try again.
- In order to get a more accurate results, you should run `source /mysql/benchmarks/improved.sql` at least 10 times to compare the results.

# Development Setup
## Programming Test Backend 
1. Bring up the containers: `docker-compose -f docker-compose.dev.yml up --build -d`
2. Run composer from within the container: `docker-compose -f docker-compose.dev.yml exec programming-backend composer install`
3. Migrate backend DB: `docker-compose -f docker-compose.dev.yml exec programming-backend bin/cake migrations migrate`
4. Fix permission: `sudo chmod -R 777 A-Programming/card-backend/tmp`

### NOTE
- DB start at port `3306`, backend server start at port `8080`, make sure that these ports are not used by other applications.
- Ports can be changed in `docker-compose.dev.yml`.

## Programming Test Frontend
1. Change directory: `cd A-Programming/card-frontend`
2. Install dependencies: `yarn install`
3. Start development server: `yarn dev`

## NOTE
- Development server start at port `3000`, make sure that the port is not used by other applications.
- Frontend assumed that backend API is at port http://localhost:8080, can be changed at `A-Programming/card-frontend/config/system.js`.

## Optional
- Seed DB: `docker-compose -f docker-compose.dev.yml exec programming-backend bin/cake migrations seed`

## Some helpful commands below:
- Invoking cake commands: `docker-compose -f docker-compose.dev.yml exec programming-backend bin/cake <command>`
