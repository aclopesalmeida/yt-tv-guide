module.exports = function(grunt) {

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        cssmin: {
            target: {
                files: {
                    'public/css/app.min.css': ['public/css/app.css']
                }
            }
        },

        uglify : {
            target: {
                files: {
                    'public/js/app.min.js': ['public/js/app.js']
                }
            }
        },

        postcss: {
            options: {
                processors: [
                    require('autoprefixer')({browsers: 'last 1 version'})
                ]
            },
            dist: {
                dist: {
                    src: 'public/css/app.css'
                }
            }
        }


    });


    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-postcss');

    grunt.registerTask('prefix', ['postcss']);
    grunt.registerTask('default', ['cssmin', 'uglify']);
}