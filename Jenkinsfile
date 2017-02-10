#!groovy

properties([[$class: 'RebuildSettings', autoRebuild: false, rebuildDisabled: false***REMOVED***, parameters([booleanParam(defaultValue: false, description: '', name: 'publish'), string(defaultValue: '--hofix', description: '', name: 'increment')***REMOVED***), pipelineTriggers([***REMOVED***)***REMOVED***)


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
    if (env.BRANCH_NAME == "master") {
        stage('Version') {
        
            if (params.publish) { 
                sh "bin/release-version $increment"
            } else {
                sh "echo Skipping"
            }
        }
    }
    stage('Measure') {
    
        if (params.publish) {
            archiveArtifacts artifacts: "build/**/*", fingerprint: true
            build job: 'gear-release', parameters: [
                [$class: 'StringParameterValue', name: 'jobName', value: "${env.JOB_NAME}"***REMOVED***
            ***REMOVED***
        } else {
            sh "echo Skipping"
        }
    }
    stage('Satis') {
        build job: 'publish-satis'
    }
    stage('Tear Down') {
    
        if (params.publish) {
            actualVersion = sh (
                script: "/usr/bin/php public/index.php gear version --clean",
                returnStdout: true
            ).trim()

            currentBuild.description = "${actualVersion}"
        } 
        
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
