plugins {
    id("com.android.application")
}

android {
    namespace = "es.iespuertodelacruz.jc.ejemplobasicoroom"
    compileSdk = 34

    defaultConfig {
        applicationId = "es.iespuertodelacruz.jc.ejemplobasicoroom"
        minSdk = 28
        targetSdk = 34
        versionCode = 1
        versionName = "1.0"

        testInstrumentationRunner = "androidx.test.runner.AndroidJUnitRunner"
    }

    buildTypes {
        release {
            isMinifyEnabled = false
            proguardFiles(
                getDefaultProguardFile("proguard-android-optimize.txt"),
                "proguard-rules.pro"
            )
        }
    }
    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_1_8
        targetCompatibility = JavaVersion.VERSION_1_8
    }
}

dependencies {


    implementation ("androidx.room:room-runtime:2.5.0")
    annotationProcessor ("androidx.room:room-compiler:2.5.0")
    androidTestImplementation ("androidx.room:room-testing:2.5.0")

// Lifecycle components

implementation ("androidx.lifecycle:lifecycle-livedata:2.5.1")
implementation ("androidx.lifecycle:lifecycle-common-java8:2.5.1")

    implementation("androidx.appcompat:appcompat:1.6.1")
    implementation("com.google.android.material:material:1.11.0")
    implementation("androidx.constraintlayout:constraintlayout:2.1.4")
    testImplementation("junit:junit:4.13.2")
    androidTestImplementation("androidx.test.ext:junit:1.1.5")
    androidTestImplementation("androidx.test.espresso:espresso-core:3.5.1")
}