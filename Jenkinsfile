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
        stage('Ejecutar pruebas Selenium') {
            steps {
                sh 'docker-compose run --rm tester'
            }
        }
    }
    post {
        always {
            junit 'test-reports/*.xml'
            archiveArtifacts artifacts: 'screenshots/*.png', fingerprint: true
        }
    }
}
