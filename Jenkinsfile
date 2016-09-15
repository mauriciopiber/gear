#!groovy

node {


    //currentBuild.result = "SUCCESS"
   
    //try { 
        stage('Clone') {
   
            checkout scm
       
        }
        stage('Prepare') {
            sh "script/deploy-testing.sh"    
            sh '/usr/bin/ant prepare'
        }
        stage('Unit PHP') {
            sh '/usr/bin/ant unit'    
        }
        stage('Quality') {
            sh '/usr/bin/ant phpcs-ci phpmd-ci phpcpd-ci'
        }
        stage('Report') {
            sh '/usr/bin/ant publish'
            step([$class: "CheckStylePublisher", canComputeNew: false, defaultEncoding: "", healthy: "", pattern: "build/logs/checkstyle.xml", unHealthy: ""***REMOVED***)
            step([$class: "PmdPublisher", canComputeNew: false, defaultEncoding: "", healthy: "", pattern: "build/logs/pmd.xml", unHealthy: ""***REMOVED***)
            step([$class: "DryPublisher", canComputeNew: false, defaultEncoding: "", healthy: "", pattern: "build/logs/pmd-cpd.xml", unHealthy: ""***REMOVED***)
            junit 'build/report.xml'
        }
        stage('Clean') {
            //deleteDir()
        }
    //}
    
    /*
    catch (err) {

        currentBuild.result = "FAILURE"
        //deleteDir()
        throw err
    }
    */
}
