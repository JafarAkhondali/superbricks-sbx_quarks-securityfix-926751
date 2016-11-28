var gulp = require('gulp');
var gtsc = require('gulp-typescript');

var settings = {
	typescript: {
		module: 'amd'
	},
	targetDir: gulp.dest('../../../Public/JavaScript/')
};

function typescript(options) {
	var defaults = settings.typescript;
	for (var name in options) {
		defaults[name] = options[name];
	}
	return gtsc(defaults);
}

gulp.task('typescript', function () {
	gulp.src('../Scripts/Element/CodeElement.ts')
		.pipe(typescript({outFile: 'Element/CodeElement.js'}))
		.pipe(settings.targetDir);
});

gulp.task('watch', function () {
	gulp.watch('../**/*.ts', ['typescript']);
});
