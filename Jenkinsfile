pipeline {
    agent any
    stages {
        stage('Clonar Repositorio') {
            steps {
                git 'https://github.com/Alonsenio/Prueba-de-Software-ProyectoDesarrolloWebIntegrado-.git'
            }
        }
        stage('Construir Contenedores') {
            steps {
                sh 'docker-compose build'
            }
        }
        stage('Desplegar') {
            steps {
                sh 'docker-compose up -d'
            }
        }
    }
}
