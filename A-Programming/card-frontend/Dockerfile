# Stage 1 build image
# Use latest node alpine variant image as builder
FROM node:current-alpine AS builder
ARG API_BASE_URL="http://localhost:8080"
WORKDIR /app
COPY package.json .
RUN yarn install
COPY . .
# Replace configuration file
COPY ./config/system.js.example ./config/system.js
RUN sed -i "s#__API_BASE_URL__#${API_BASE_URL}#" ./config/system.js
# Build
RUN yarn build && yarn --production

# Stage 2 host static contents
FROM node:current-alpine
WORKDIR /app
COPY --from=builder /app .
EXPOSE 3000
CMD ["node_modules/.bin/next", "start"]
