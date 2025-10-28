# Use official PHP image with built-in web server
FROM php:8.2-cli

# Copy project files into the container
COPY . /app
WORKDIR /app

# Expose port 10000 (Render uses this for web apps)
EXPOSE 10000

# Start PHP’s built-in web server
CMD ["php", "-S", "0.0.0.0:10000"]
