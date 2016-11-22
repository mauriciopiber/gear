#!groovy

node('master') {

    stage('Prepare') {
        checkout scm
        sh 'script/deploy-testing.sh'
        sh '/usr/bin/ant prepare'
    }
    stage('Quality') {
        sh '/usr/bin/ant phpcs-ci phpmd-ci phpcpd-ci'
    }
    try {
        stage('Unit PHP') {
            sh '/usr/bin/ant unit-ci'    
        }
    }
    catch (err) {

        archiveCopyPastResults()
        archiveMessDetectorResults()
        archiveCheckstyleResults()
        archiveUnitTestResults()

        throw err
    }
   
    stage('Report') {
        archiveCopyPastResults()
        archiveMessDetectorResults()
        archiveCheckstyleResults()
        archiveUnitTestResults()

    }
    /*
    if (env.BRANCH_NAME == "master") {
        stage('Version') {
            sh '/usr/bin/php public/index.php gear deploy bump --hotfix'
        }
    }
    */
    stage('Measure') {
        build 'gear-release'
    }
    stage('Tear Down') {
        deleteDir();
    }
}

def archiveCopyPastResults() {

    step([$class: "DryPublisher", 
            canComputeNew: false, 
            defaultEncoding: "", 
            healthy: "100", 
            pattern: "build/logs/pmd-cpd.xml", 
            unHealthy: "80"***REMOVED***)

}

def archiveCheckstyleResults() {

    step([$class: "CheckStylePublisher", 
            canComputeNew: false, 
            defaultEncoding: "", 
            healthy: "100", 
            pattern: "build/logs/checkstyle.xml", 
            unHealthy: "80"***REMOVED***)

}

def archiveMessDetectorResults() {

    step([$class: "PmdPublisher", 
            canComputeNew: false, 
            defaultEncoding: "", 
            healthy: "100", 
            pattern: "build/logs/pmd.xml", 
            unHealthy: "80"***REMOVED***)

}

def archiveUnitTestResults() {

    junit 'build/report.xml'
}