'use strict';
module.exports = function(grunt){

    // load all tasks
    require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

    grunt.initConfig({
        
        pkg: grunt.file.readJSON('package.json'),
        
        makepot: {
            target: {
               options: {
                    domainPath: '/languages/',    // Where to save the POT file.
                    potFilename: '<%= pkg.name %>.pot',   // Name of the POT file.
                    potHeaders: {
                    poedit: true, // Includes common Poedit headers.
                        'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
                },
                    type: 'wp-theme',  // Type of project (wp-plugin or wp-theme).
                    updateTimestamp: false, // Update timestamp if there's no string changes.
                    processPot: function( pot, options ) {
                    pot.headers['report-msgid-bugs-to'] = 'http://themebeans.com/';
                        pot.headers['last-translator'] = 'WP-Translations (http://wp-translations.org/)';
                        pot.headers['language-team'] = 'WP-Translations <wpt@wp-translations.org>';
                        pot.headers['language'] = 'en_US';
                        return pot;
                }
               }
            }
        },
        clean: {
            init: {
                src: ['_dist/<%= pkg.name %>-<%= pkg.version %>.zip', '_dist/<%= pkg.name %>', '_dist/<%= pkg.name %>.zip']
            },
            build: {
                src: ['_dist/*', '!_dist/<%= pkg.name %>.zip']
            }
        },
        autoprefixer: {
            options: {
                browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie 9']
            },
            single_file: {
                src: 'style.css',
                dest: 'style.css'
            }
        },
        csscomb: {
            dist: {
                options: {
                    config: 'csscomb.json'
                },
                files: {
                    'style.css': ['style.css']
                }
            }
        },
        cssmin: {
          options: {
            shorthandCompacting: false,
            roundingPrecision: -1
          },
          target: {
            files: {
              'style-min.css': ['style.css']
            }
          }
        },
        concat: {
            release: {
                src: [
                    'js/src/animsition.js',
                    'js/src/fitvids.js',
                    'js/src/isotope.js',
                    'js/src/images-loaded.js',
                    'js/src/svg4everybody.js',
                    'js/src/infinitescroll.js', 
                ],
                dest: 'js/combined-min.js'
            }
        },
        uglify: {
            release: {
                src: 'js/combined-min.js',
                dest: 'js/combined-min.js'
            },
            functions: {
                src: 'js/src/functions.js',
                dest: 'js/functions-min.js'
            }
        },
        replace: {
            styleVersion: {
                src: [
                    'style.css',
                ],
                overwrite: true,
                replacements: [{
                    from: /Version: .*$/m,
                    to: 'Version: <%= pkg.version %>'
                }]
            },
            functionsVersion: {
                src: [
                    'functions.php'
                ],
                overwrite: true,
                replacements: [ {
                    from: /^define\( 'YORK_VERSION'.*$/m,
                    to: 'define( \'YORK_VERSION\', \'<%= pkg.version %>\' );'
                } ]
            },
            functionsDebug: {
                src: [
                    'functions.php',
                ],
                overwrite: true,
                replacements: [{
                    from: /^define\( 'YORK_DEBUG'.*$/m,
                    to: 'define( \'YORK_DEBUG\', false );'
                }]
            },
            changelogVersion: {
                src: [
                    'changelog.txt',
                ],
                overwrite: true,
                replacements: [ {
                    from: /^Version: .*$/m,
                    to: 'Version: <%= pkg.version %>'
                } ]
            },
            readmeVersion: {
                src: [
                    'readme.md',
                ],
                overwrite: true,
                replacements: [ {
                    from: /^Version: .*$/m,
                    to: 'Version: <%= pkg.version %>'
                } ]
            },
            mdMod: {
                src: [
                    '_dist/readme.txt',
                ],
                overwrite: true,
                replacements: [ {
                    from: '# ',
                    to: '=== '
                } ]
            },
            mdMod2: {
                src: [
                    '_dist/readme.txt',
                ],
                overwrite: true,
                replacements: [ {
                    from: ' #',
                    to: ' ==='
                } ]
            },
            mdMod3: {
                src: [
                    '_dist/readme.txt',
                ],
                overwrite: true,
                replacements: [ {
                    from: '#===',
                    to: '=='
                } ]
            },
            mdMod4: {
                src: [
                    '_dist/readme.txt',
                ],
                overwrite: true,
                replacements: [ {
                    from: '===#',
                    to: '=='
                } ]
            },
        },
        copy: {
            readme: {
                src: 'readme.md',
                dest: '_dist/readme.txt'
            },
            build: {
                expand: true,
                src: ['**', '!node_modules/**', '!_dist/**', '!_dist/**', '!readme.md', '!gruntfile.js', '!Gruntfile.js', '!csscomb.json', '!sftp-config.json', '!package.json', '!york.sublime-project', '!york.sublime-workspace' ],
                dest: '_dist/'
            }
        },
        compress: {
            build: {
                options: {
                    archive: '_dist/<%= pkg.name %>.zip'
                },
                expand: true,
                cwd: '_dist/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            },
            package: {
                options: {
                    archive: '_dist/<%= pkg.name %>.zip'
                },
                expand: true,
                cwd: '_dist/',
                src: ['**/*'],
                dest: '<%= pkg.name %>/'
            }
        },


        
    });

    grunt.registerTask('default', []);

    grunt.registerTask( 'cssbuild', [ 
        'autoprefixer',
        'csscomb',
        'cssmin',
    ]);    

    grunt.registerTask( 'jsbuild', [ 
        'concat',
        'uglify',
    ]); 

    // Build task
    grunt.registerTask( 'build', [ 
        'makepot',
        'replace:styleVersion',
        'replace:functionsVersion',
        'replace:changelogVersion',
        'replace:functionsDebug',
        'replace:readmeVersion',    
        'autoprefixer',
        'csscomb',
        'cssmin',
        'concat',
        'uglify',
        'clean:init', 
        'force:copy',
        'replace:mdMod',
        'replace:mdMod2',
        'replace:mdMod3',
        'replace:mdMod4',
        'compress:build',
        'clean:build',
        
        
    ]);    
};