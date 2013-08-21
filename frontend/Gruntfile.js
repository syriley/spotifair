module.exports = function(grunt) {
    'use strict';
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            scripts: {
                files: [
                    'build/js/**',
                    'tests/**',
                    'src/less/**',
                    '!node_modules/**/*.js',
                    '!build/js/templates/templates.js',
                ],
                tasks: ['default'],
                options: {
                    nospawn: true
                }
            }
        },
        less: {
            development: {
                options: {
                    paths: ['src/less']
                },
                files: {
                    'build/css/style.css':'src/less/style.less'
                }
            }
        },
        cssmin: {
            options: {
                banner: '/*! <%= pkg.name %> Styles */\n'
            },
            css: {
                src: 'build/css/style.css',
                dest: 'build/css/style.min.css',
            }
        },
        handlebars: {
            compile: {
                options: {
                    amd: true,
                    namespace: 'Templates',
                    processName: function(filename) {
                        return filename.substring(filename.indexOf('/',12) + 1);
                    }
                },
                files: {
                    'build/js/templates/templates.js': 'build/js/**/*.html',
                }
            }
        },
        mocha: {
            src: ['tests/index.html'],
            options: {
                mocha: {
                    ignoreLeaks: true,
                    // grep: 'food'
                },
                ui: 'bdd',
                // run: true,
                reporter: 'Spec',
            },
        },
        requirejs: {
          compile: {
            options: {
              findNestedDependencies: true,   
              baseUrl: "build/js",
              name: 'app',
              mainConfigFile: "build/js/main.js",
              out: "build/js/optimized.js",
              optimize: 'none',
            }
          }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-handlebars');
    grunt.loadNpmTasks('grunt-mocha');
    grunt.loadNpmTasks('grunt-contrib-requirejs');


    // Default task(s).
    grunt.registerTask('default', ['less', 'cssmin', 'handlebars']);
    grunt.registerTask('test', ['mocha']);

};