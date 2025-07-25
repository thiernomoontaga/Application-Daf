#!/bin/bash

# Script de déploiement pour Render
set -e

echo "🚀 Déploiement de l'API DAF sur Render..."

# Vérifier que les variables d'environnement sont définies
if [ -z "$DB_DSN_POSTGRES" ]; then
    echo "❌ Variable DB_DSN_POSTGRES non définie"
    exit 1
fi

if [ -z "$CLOUDINARY_CLOUD_NAME" ]; then
    echo "❌ Variable CLOUDINARY_CLOUD_NAME non définie"
    exit 1
fi

echo "✅ Variables d'environnement validées"

# Exécuter les migrations si nécessaire
echo "📊 Exécution des migrations..."
php bin/migrate

echo "🎉 Déploiement terminé avec succès!"
echo "🌐 API disponible sur le port 80"
