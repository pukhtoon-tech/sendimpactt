
var createUrl = $('#template_create_url').val();
var updateUrl = $('#template_update_url').val();
var templates = $('#templates_index_url').val();
var img = $('#templates_img_url').val();

var owner_id = $('#auth_user').val();
var title = $('#template_title').val();

var p = [
		"gjs-preset-newsletter",
		"grapesjs-plugin-export",
		"grapesjs-style-gradient",
		"grapesjs-custom-code",
		"grapesjs-touch",
		"grapesjs-parser-postcss"
	];

const myNewComponentTypes = editor => {

	editor.DomComponents.addType("simple-row", {
		extend: "row",
		model: {
			defaults: {
				tagName: "tr",
				name: "name",
				draggable: "main",
				copyable: true,
				removable: true,
				components: {
					tagName: "td",
					name: "unrecognized-td",
					hoverable: true,
					draggable: true,
					selectable: true,
					removable: true,
					highlightable: true
				}
			}
		}
	});
};
p.push(myNewComponentTypes);

var editor = grapesjs.init({
	fromElement: true,
	height: "92vh",
	container: "#gjs",
	forceClass: false,
	storageManager: { type: "none" },
	plugins: p
});

// new Blocks
var blockManager = editor.BlockManager;

// 3 => 7/3 Section
blockManager.add('7-3-section', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/7-3.svg" +'" class="t-img"><div class="my-label-block">7/3 Section</div></div></div>',
	content: '<table style="width: 100%; height: 150px;"><tr><td style="width: 70%;"></td><td style="width: 30%;"></td></tr></table>',
  });


// 4 => 4/4 Section
blockManager.add('4-4-section', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/4-section.svg" +'" class="t-img"><div class="my-label-block">4 Columns</div></div></div>',
	content: '<table style="width: 100%; height: 150px;"><tr><td style="width: 25%;"></td><td style="width: 25%;"></td><td style="width: 25%;"></td><td style="width: 25%;"></td></tr></table>',
  });
// STORE

function saveTem(){

    // GET html5-template
    var html = editor.getHtml();
    var css = editor.getCss();
    var htmlWithCss = editor.runCommand('gjs-get-inlined-html');

	var title = $('#template_title').val();
	var id = $('#id').val();

	if (title == "") {

		alert('Template title is required.');
		
	}else{

		// ajax setup

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: createUrl,
			data:{
				id: id,
				html: html,
				css: css,
				htmlWithCss: htmlWithCss,
				owner_id: owner_id,
				title: title,
			},
			success: function(response) {
				console.log(response);
				window.location = templates;
			}
		});

	}

	
}

// UPDATE

function updateTem(){

    // GET html5-template
    var html = editor.getHtml();
    var css = editor.getCss();
    var htmlWithCss = editor.runCommand('gjs-get-inlined-html');

	var title = $('#template_title').val();

	if (title == "") {
		alert('Template title is required.');
	} else {

		// ajax setup

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: updateUrl,
			data:{
				html: html,
				css: css,
				htmlWithCss: htmlWithCss,
				owner_id: owner_id,
				title: title,
			},
			success: function(response) {
				console.table(response);
			}
		});
	}

	
}

/**
 * Section Block
 */


// Section 1
blockManager.add('section-1', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/section-1.svg" +'" class="t-img"><div class="my-label-block">Section 1</div></div></div>',
	content: '<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td class="bg_dark email-section" style="text-align:center;"><div class="heading-section heading-section-white"> <span class="subheading">Welcome</span><h2>Welcome To RestoBar</h2><p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p></div></td></tr></table>',
	category: 'Sections',
	attributes: {
		title: 'Insert Section 1'
	}
});

// Section 2
blockManager.add('section-2', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/section-2.svg" +'" class="t-img"><div class="my-label-block">Section 2</div></div></div>',
	content: '<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td class="bg_white email-section"><div class="heading-section" style="text-align: center; padding: 0 30px;"> <span class="subheading">Services</span><h2>Our Services</h2><p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p></div><table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td class="icon"> <img src="'+ '/001-diet.png' +'" alt="" style="width: 60px; max-width: 600px; height: auto; margin: auto; display: block;"></td></tr><tr><td class="text-services"><h3>Healthy Foods</h3><p>Far far away, behind the word mountains, far from the countries</p></td></tr></tbody></table></td><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td class="icon"> <img src="'+ '/003-recipe-book.png' +'" alt="" style="width: 60px; max-width: 600px; height: auto; margin: auto; display: block;"></td></tr><tr><td class="text-services"><h3>Original Recipes</h3><p>Far far away, behind the word mountains, far from the countries</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></table>',
	category: 'Sections',
	attributes: {
		title: 'Insert Section 2'
	}
});

// Section 3
blockManager.add('section-3', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/section-3.svg" +'" class="t-img"><div class="my-label-block">Section 3</div></div></div>',
	content: '<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td class="bg_white email-section"><div class="heading-section" style="text-align: center; padding: 0 30px;"> <span class="subheading">Menu</span><h2>Our Delicious Food</h2><p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p></div><table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td style="padding-right: 10px;"> <img src="'+ '/menu-1.jpg' +'" alt="" style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;"></td></tr><tr><td class="text-services" style="text-align: left;"><h3>Pasta, Sauce Milk</h3><p>Far far away, behind the word mountains, far from the countries</p><p><a href="#" class="btn btn-primary">Read more</a></p></td></tr></tbody></table></td><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td style="padding-left: 10px;"> <img src="'+ '/menu-2.jpg' +'" alt="" style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;"></td></tr><tr><td class="text-services" style="text-align: left;"><h3>Sweetened Fruits</h3><p>Far far away, behind the word mountains, far from the countries</p><p><a href="#" class="btn btn-primary">Read more</a></p></td></tr></tbody></table></td></tr></tbody></table></td></tr></table>',
	category: 'Sections',
	attributes: {
		title: 'Insert Section 3'
	}
});

// Section 4
blockManager.add('section-4', {
	label: '<div class="tsp"><div class="tsc"><img src="'+ img + "/section-4.svg" +'" class="t-img"><div class="my-label-block">Section 4</div></div></div>',
	content: '<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td class="bg_light email-section"><div class="heading-section" style="text-align: center; padding: 0 30px;"> <span class="subheading">Says</span><h2>Testimonial</h2><p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p></div><table role="presentation" border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td> <img src="images/person_1.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; margin-bottom: 20px; display: block; border-radius: 50%;"></td></tr><tr><td class="text-testimony" style="text-align: center;"><h3 class="name">Ronald Tuff</h3> <span class="position">Businessman</span><p>Far far away, behind the word mountains, far from the countries</p><p><a href="#" class="btn btn-primary">Read more</a></p></td></tr></tbody></table></td><td valign="top" width="50%" style="padding-top: 20px;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody><tr><td> <img src="images/person_2.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; margin-bottom: 20px; display: block; border-radius: 50%;"></td></tr><tr><td class="text-testimony" style="text-align: center;"><h3 class="name">Willam Clarson</h3> <span class="position">Businessman</span><p>Far far away, behind the word mountains, far from the countries</p><p><a href="#" class="btn btn-primary">Read more</a></p></td></tr></tbody></table></td></tr></tbody></table></td></tr></table>',
	category: 'Sections',
	attributes: {
		title: 'Insert Section 4'
	}
});
