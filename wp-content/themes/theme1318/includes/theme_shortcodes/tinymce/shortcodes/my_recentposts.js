frameworkShortcodeAtts={
	attributes:[
			{
				label:"How many posts to show?",
				id:"num",
				help:"This is how many recent posts will be displayed."
			},
			{
				label:"Type of posts",
				id:"type",
				help:"This is the type of posts. Use post slug, e.g. \"portfolio\""
			},
			{
				label:"Meta",
				id:"meta",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable meta information."
			},
			{
				label:"Do you want to show the featured image?",
				id:"thumb",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable featured image."
			},
			{
				label:"Featured image size",
				id:"thumb_size",
				help:"Get it from the theme-init.php, e.g. \"small-post-thumbnail\""
			},
			{
				label:"Link Text for post",
				id:"more_text_single",
				help:"Link Text for post."
			},
			{
				label:"Which category to pull from?",
				id:"category",
				help:"Enter the slug for the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"The number of characters in the excerpt",
				id:"excerpt_count",
				help:"How many characters are displayed in the excerpt?"
			},
			{
				label:"Custom class",
				id:"custom_class",
				help:"Use this field if you want to use a custom class for posts."
			},
			{
				label:"Link URL",
				id:"more_link",
				help:"Link URL."
			},
			{
				label:"Link Text",
				id:"more_text",
				help:"Link Text."
			}
	],
	defaultContent:"",
	shortcode:"recent_posts",
	shortcodeType: "text-replace"
};