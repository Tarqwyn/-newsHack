module.exports = function (grunt) { 

  //Loading the grunt tasks.
    require('load-grunt-tasks')(grunt, ['grunt-contrib-*']);
  
  // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            js: ['js/compiled'],
            inc: ['inc/compiled']
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'js/main.js',
                dest: 'inc/compiled/main_js.inc'
            }
        },
        jshint: {
            options: {
                indent: 4,
                curly: true,
                eqeqeq: true,
                immed: true,
                latedef: true,
                newcap: true,
                noarg: true,
                quotmark: true,
                sub: true,
                boss: true,
                eqnull: true,
                white: true//,
                // toggle force to true on if using JSHint with watch
                // force: true
            },
            all: ['Gruntfile.js', 'js/*.js', 'js/module/*.js', 'test/*.js']
        },
        requirejs: {
            desktop: {
                options: {
                    baseUrl: '.',
                    paths: {
                        'js': 'js/module',  
                        'lib': 'js/lib',
                        'bootstrap': 'js/bootstrap',
                        'jquery-1': 'empty:',
                        'istats-1': 'empty:'
                      
                    },
                    name: 'js/app',
                    out: 'js/compiled/desktop/ns_all.js',
                    optimize: 'uglify'
                }
            },
            mobile: {
                options: {            
                    baseUrl: '.',
                    paths: {
                        'js': 'js/module',
                        'lib': 'js/lib',
                        'bootstrap': 'js/bootstrap',
                        'jquery-1': 'empty:',
                        'vendor/istats/istats': 'empty:',
                        'd3': 'js/lib/d3.v3.min'
                    },
                    out: 'js/compiled/mobile/ns_all.js',
                    name: 'js/app',
                    optimize: 'uglify'
                }
            },
            syndicate: {
                options: {            
                    baseUrl: '.',
                    paths: {
                        'js': 'js/module',
                        'bootstrap': 'js/bootstrap-desktop',
                        'jquery-1': '../../../vendor/libs/jquery-1.7.2',
                        'istats-1': '../../../vendor/libs/istats-1',
                        'lib': 'js/lib'
                    },
                    out: 'js/compiled/syndicate/ns_all.js',
                    name: 'js/app',
                    optimize: 'uglify'
                }
            }
        },
        sass: {
            dist: {
                files: {
                    'css/main.css': 'sass/main.scss'
                },
                options: {
                    style : 'compressed'
                }
            }
        },
        qunit: {
            all: {
                options: {
                    urls: [
                        'http://localhost:8888/news/special/2013/newshack/test/test.html'
                    ]
                }
            }
        },
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 3
                },
                files: [
                    {
                        expand: true,
                        src: ['img/*.*'],
                        dest: './'
                    }
                ]
            },
            css: {
                options: {
                    optimizationLevel: 3
                },
                files: [
                    {
                        expand: true,
                        src: ['css/img/*.*'],
                        dest: './'
                    }
                ]
            }
        },
        watch: {
            scripts: {
                files: 'js/**/*.js',
                tasks: ['jshint'],
                options: {
                    nospawn: true
                }
            },
            css: {
                files: 'sass/*.scss',
                tasks: ['sass']
            }
        },
        copy: {
            stage: {
                files: [
                    {expand: true, src: ['css/**'], dest: '/Volumes/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['inc/**'], dest: '/Volumes/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['img/**'], dest: '/Volumes/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['j_inc/**'], dest: '/Volumes/wwwlive/news/special/2013/newshack'},      
                    {expand: true, src: ['js/compiled/**'], dest: '/Volumes/wwwlive/news/special/2013/newshack'} 
                ]
            },
            live: {
                files: [
                    {expand: true, src: ['css/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['inc/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['img/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['j_inc/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},        
                    {expand: true, src: ['js/compiled/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'} 
                ]
            },
            debug: {
                files: [
                    {expand: true, src: ['css/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['inc/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['img/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['j_inc/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},        
                    {expand: true, src: ['js/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'},
                    {expand: true, src: ['js/lib/images/**'], dest: '/Volumes/Inetpub/wwwlive/news/special/2013/newshack'}
                ]
            }
        }   
    });

    grunt.registerTask('hint', ['jshint']);
    grunt.registerTask('test', ['qunit']);
    grunt.registerTask('stage', ['imagemin', 'copy:stage']);
    grunt.registerTask('syndicate', ['requirejs:syndicate']);
    grunt.registerTask('stage', ['copy:stage']);
    grunt.registerTask('checkStage', ['Checking content on stage'], function () {
        var path = require('path'),
            done = this.async(),
            fs = require('fs');

        try {
          // Query the entry
            stats = fs.lstatSync('/Volumes/wwwlive/news/special/2013/99999');
          // Is it a directory?
            if (stats.isDirectory()) {
                grunt.log.writeln('This content is on stage - OK');
                done();
            }
        } catch (e) {
            done(false);
            grunt.log.writeln('This content has not been staged - Fail');
        }
    });
    grunt.registerTask('live', ['checkStage', 'copy:live']);
    // Default task(s).
    grunt.registerTask('default', ['clean', 'jshint', 'uglify', 'requirejs:desktop', 'requirejs:mobile', 'sass']);

};