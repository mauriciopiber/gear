#!groovy
@Library('gear-jenkins-library') _

pipeline {
    agent any
    parameters {
        string(name: 'increment', defaultValue: '--hotfix', description: 'What type of increment should be?')
        booleanParam(name: 'publish', defaultValue: false, description: 'Should be published?')
    }
    stages {
        stage('Prepare') {
            steps {
                notifyBuild()
                checkout scm
                sh 'script/deploy-testing.sh'
                sh '/usr/bin/ant prepare'
                sh '/usr/bin/ant parallel-lint'
            }
        }
        stage('Quality') {
            steps {
                sh '/usr/bin/ant phpcs-ci phpmd-ci phpcpd-ci'
            }
        }
        stage('Unit PHP') {
            post {
                failure {
                    postAction()
                }
            }
            steps {
                sh '/usr/bin/ant unit-ci'
            }
        }
        stage('Report') {
            steps {
                archiveArtifacts artifacts: "build/**/*", fingerprint: true
                postAction()
            }
        }
        stage('Version') {
            when {
                expression {
                    return params.publish
                }
            }
            steps {
                publishVersion(currentBuild, params.increment)
            }
        }
        stage('Measure') {
            when {
                expression {
                    return params.publish
                }
            }
            steps {
                build job: 'release-gear', parameters: [
                    [$class: 'StringParameterValue', name: 'jobName', value: "${env.JOB_NAME}"***REMOVED***,
                    [$class: 'StringParameterValue', name: 'upWorkspace', value: "${env.WORKSPACE}"***REMOVED***
                ***REMOVED***
            }
        }
    }
    post {
        always {
            deleteDir() /* clean up our workspace */
            notifyBuild(currentBuild.result)
        }
    }
}
