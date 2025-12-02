#!/bin/bash
# Выполняет команды в MySQL через Sail

echo "Setting MySQL character sets..."

# Выполняем команды в MySQL
./vendor/bin/sail mysql -u root -p"${DB_PASSWORD}" <<EOF
SET NAMES 'utf8mb4';
EOF

echo "Done!"