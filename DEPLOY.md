# Déploiement de l'API DAF sur Render

## 📋 Prérequis

1. **Compte Render** : [render.com](https://render.com)
2. **Base de données PostgreSQL** : Railway (déjà configuré)
3. **Cloudinary** : Account pour l'upload d'images
4. **Repository Git** : Code pushé sur GitHub

## 🚀 Étapes de déploiement

### 1. Préparer les variables d'environnement

Sur Render, configurer ces variables :

```bash
# Database Railway
DB_DSN_POSTGRES=postgresql://username:password@host:port/database
DB_USER_POSTGRES=username
DB_PASS_POSTGRES=password
DB_DRIVER=pgsql

# Cloudinary
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret

# Upload
UPLOAD_DIR=images/uploads/
```

### 2. Créer un Web Service sur Render

1. **Se connecter à Render** : [dashboard.render.com](https://dashboard.render.com)

2. **Nouveau Web Service** :

   - Cliquer sur "New" > "Web Service"
   - Connecter votre repository GitHub
   - Sélectionner le repository `Application-Daf`

3. **Configuration du service** :

   ```
   Name: daf-api
   Environment: Docker
   Region: Frankfurt (ou la plus proche)
   Branch: main
   Root Directory: (laisser vide)
   ```

4. **Build Settings** :

   - **Build Command** : `docker build -t daf-api .`
   - **Start Command** : (laisser vide, le CMD du Dockerfile sera utilisé)

5. **Environment Variables** :
   Ajouter toutes les variables listées ci-dessus

### 3. Configuration avancée

Dans "Advanced" settings :

- **Port** : `80` (port exposé par nginx)
- **Health Check Path** : `/api/v1`
- **Auto-Deploy** : `Yes` (déploiement automatique sur push)

### 4. Déployer

1. Cliquer sur "Create Web Service"
2. Render va :
   - Cloner votre repository
   - Construire l'image Docker
   - Déployer l'application
   - Fournir une URL publique

## 🔧 Structure Docker

### Architecture déployée :

```
┌─────────────────┐
│     Nginx       │ ← Port 80 (public)
│   (Reverse      │
│    Proxy)       │
└─────────┬───────┘
          │
┌─────────▼───────┐
│    PHP-FPM      │ ← Port 9000 (interne)
│   (Application) │
└─────────────────┘
```

### Services gérés par Supervisor :

- **nginx** : Serveur web (port 80)
- **php-fpm** : Application PHP (port 9000)

## 📡 URLs de test

Une fois déployé, votre API sera disponible sur :

```
https://daf-api-xxx.onrender.com/api/v1/citoyens
https://daf-api-xxx.onrender.com/api/v1/citoyens/{cni}
```

## 🔍 Vérification du déploiement

Tester les endpoints :

```bash
# Liste des citoyens
curl https://daf-api-xxx.onrender.com/api/v1/citoyens

# Recherche par CNI
curl https://daf-api-xxx.onrender.com/api/v1/citoyens/19901150001
```

## 🐛 Debugging

Render fournit des logs en temps réel dans la section "Logs" du dashboard.

Types de logs utiles :

- **Build Logs** : Construction de l'image Docker
- **Deploy Logs** : Processus de déploiement
- **Service Logs** : Logs applicatifs (nginx + PHP)

## 💡 Optimisations pour la production

1. **Cache Redis** : Ajouter un service Redis pour le cache
2. **CDN** : Utiliser Cloudinary comme CDN pour les images
3. **Monitoring** : Configurer des alertes de santé
4. **SSL** : Automatiquement géré par Render
5. **Auto-scaling** : Disponible sur les plans payants

## 🔐 Sécurité

- Variables d'environnement chiffrées par Render
- HTTPS automatique avec certificats Let's Encrypt
- Headers de sécurité configurés dans nginx
- Accès base de données via SSL (Railway)

## 💰 Coûts estimés

- **Render Web Service** : $7/mois (plan Starter)
- **Railway PostgreSQL** : $5/mois
- **Cloudinary** : Gratuit jusqu'à 25k transformations/mois
- **Total** : ~$12/mois pour une API production-ready
