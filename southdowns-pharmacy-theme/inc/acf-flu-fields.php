<?php
/**
 * ACF Local Field Group — Flu Vaccinations Page
 * Applies to: page-templates/page-flu-vaccinations.php
 * Hero fields are already read via sp_field()/get_field() in the template; defining
 * them here makes them editable + pre-filled. Repeaters seeded via load_value.
 */

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key' => 'group_flu_page', 'title' => 'Flu Vaccinations — Page Content',
		'position' => 'acf_after_title', 'style' => 'default', 'label_placement' => 'top', 'hide_on_screen' => [ 'the_content' ],
		'location' => [ [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'page-templates/page-flu-vaccinations.php' ] ] ],
		'fields' => [
			[ 'key' => 'field_fv_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_hero_image', 'label' => 'Hero Image', 'name' => 'fv_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_fv_hero_badge', 'label' => 'Badge', 'name' => 'fv_hero_badge', 'type' => 'text', 'default_value' => 'NHS &amp; Private &middot; Same-Day Appointments' ],
			[ 'key' => 'field_fv_hero_headline', 'label' => 'Headline', 'name' => 'fv_hero_headline', 'type' => 'text', 'default_value' => 'Protect Yourself This Flu Season' ],
			[ 'key' => 'field_fv_hero_body', 'label' => 'Body', 'name' => 'fv_hero_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Private flu jabs and NHS flu vaccinations at Southdowns Pharmacy Group. Quick, convenient protection against this year&rsquo;s seasonal flu strain &mdash; available across Emsworth, Havant, Leigh Park and Rowlands Castle.' ],

			[ 'key' => 'field_fv_tab_stats', 'label' => 'Stats', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_stats', 'label' => 'Stats', 'name' => 'fv_stats', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat', 'sub_fields' => [
				[ 'key' => 'field_fv_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ],
				[ 'key' => 'field_fv_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ],
				[ 'key' => 'field_fv_stat_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text' ],
			] ],

			[ 'key' => 'field_fv_tab_intro', 'label' => 'Intro', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_intro_eyebrow', 'label' => 'Eyebrow', 'name' => 'fv_intro_eyebrow', 'type' => 'text', 'default_value' => 'Why It Matters' ],
			[ 'key' => 'field_fv_intro_heading', 'label' => 'Heading', 'name' => 'fv_intro_heading', 'type' => 'text', 'default_value' => 'The Importance of the Flu Vaccine' ],
			[ 'key' => 'field_fv_intro_body', 'label' => 'Body', 'name' => 'fv_intro_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>For most people the flu is a miserable week in bed &mdash; but for some it can be serious, even life-threatening, particularly those with underlying health conditions. A seasonal flu vaccine is one of the simplest, most effective ways to reduce your risk of illness and its complications.</p><p>Whether you choose a free <strong>NHS flu vaccination</strong> or a convenient <strong>private flu jab</strong>, getting protected against this year&rsquo;s strain gives you peace of mind &mdash; less time off work, and a layer of protection for the vulnerable people around you.</p><p>The best time to be vaccinated is in <strong>autumn or early winter</strong>, before flu starts circulating widely. Left it late? Don&rsquo;t worry &mdash; private flu vaccination remains available throughout the season.</p>' ],
			[ 'key' => 'field_fv_intro_image', 'label' => 'Intro Image', 'name' => 'fv_intro_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ],
			[ 'key' => 'field_fv_intro_btn', 'label' => 'Button Label', 'name' => 'fv_intro_btn', 'type' => 'text', 'default_value' => 'Book Your Flu Jab' ],

			[ 'key' => 'field_fv_tab_elig', 'label' => 'NHS Eligibility', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_elig_eyebrow', 'label' => 'Eyebrow', 'name' => 'fv_elig_eyebrow', 'type' => 'text', 'default_value' => 'Free NHS Flu Vaccinations' ],
			[ 'key' => 'field_fv_elig_heading', 'label' => 'Heading', 'name' => 'fv_elig_heading', 'type' => 'text', 'default_value' => 'Are You Eligible for a Free Jab?' ],
			[ 'key' => 'field_fv_elig_intro', 'label' => 'Intro', 'name' => 'fv_elig_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'You can get your seasonal flu vaccine free on the NHS if you fall into one of the groups below. Not eligible? You can still book a private flu jab with us in minutes.' ],
			[ 'key' => 'field_fv_eligible', 'label' => 'Eligibility Cards', 'name' => 'fv_eligible', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card', 'instructions' => 'Icons stay fixed by position.', 'sub_fields' => [
				[ 'key' => 'field_fv_elig_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_fv_elig_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ],
			] ],
			[ 'key' => 'field_fv_elig_note', 'label' => 'Footnote', 'name' => 'fv_elig_note', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Please note: NHS flu vaccine eligibility may change in line with NHS guidance. The information here is accurate at the time of writing and is subject to update.' ],

			[ 'key' => 'field_fv_tab_cond', 'label' => 'Conditions', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_cond_eyebrow', 'label' => 'Eyebrow', 'name' => 'fv_cond_eyebrow', 'type' => 'text', 'default_value' => 'Long-Term Health Conditions' ],
			[ 'key' => 'field_fv_cond_heading', 'label' => 'Heading', 'name' => 'fv_cond_heading', 'type' => 'text', 'default_value' => 'Which Conditions Make You Eligible?' ],
			[ 'key' => 'field_fv_cond_intro', 'label' => 'Intro', 'name' => 'fv_cond_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'If you live with any of the following long-term conditions, you&rsquo;re likely entitled to a free NHS flu vaccination. Tap each one to learn more.' ],
			[ 'key' => 'field_fv_conditions', 'label' => 'Conditions (accordion)', 'name' => 'fv_conditions', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Condition', 'sub_fields' => [
				[ 'key' => 'field_fv_cond_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_fv_cond_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ],
			] ],
			[ 'key' => 'field_fv_cond_note', 'label' => 'Note Box', 'name' => 'fv_cond_note', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Eligibility criteria for the NHS flu vaccine may change based on NHS guidance. If you&rsquo;re unsure whether you qualify, our pharmacists will happily check for you &mdash; just ask in branch or when you book.' ],

			[ 'key' => 'field_fv_tab_priv', 'label' => 'Private Flu Jab', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_priv_offer', 'label' => 'Offer Label', 'name' => 'fv_priv_offer', 'type' => 'text', 'default_value' => 'Seasonal Introductory Offer' ],
			[ 'key' => 'field_fv_priv_price', 'label' => 'Price', 'name' => 'fv_priv_price', 'type' => 'text', 'default_value' => '£20' ],
			[ 'key' => 'field_fv_priv_price_suffix', 'label' => 'Price Suffix', 'name' => 'fv_priv_price_suffix', 'type' => 'text', 'default_value' => 'per private flu jab' ],
			[ 'key' => 'field_fv_priv_body', 'label' => 'Card Body', 'name' => 'fv_priv_body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => 'Don&rsquo;t qualify for a free NHS vaccination? Our convenient private flu jab service gives adults fast, reliable protection against seasonal flu &mdash; no appointment marathon, no GP referral.' ],
			[ 'key' => 'field_fv_priv_points', 'label' => 'Card Points', 'name' => 'fv_priv_points', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Point', 'sub_fields' => [ [ 'key' => 'field_fv_priv_point_text', 'label' => 'Point', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_fv_priv_btn', 'label' => 'Card Button', 'name' => 'fv_priv_btn', 'type' => 'text', 'default_value' => 'Book Your Private Flu Jab' ],
			[ 'key' => 'field_fv_priv_r_eyebrow', 'label' => 'Right Eyebrow', 'name' => 'fv_priv_r_eyebrow', 'type' => 'text', 'default_value' => 'Private Flu Vaccination' ],
			[ 'key' => 'field_fv_priv_r_heading', 'label' => 'Right Heading', 'name' => 'fv_priv_r_heading', 'type' => 'text', 'default_value' => 'Where Can I Get a Private Flu Jab?' ],
			[ 'key' => 'field_fv_priv_r_body', 'label' => 'Right Body', 'name' => 'fv_priv_r_body', 'type' => 'wysiwyg', 'tabs' => 'visual', 'toolbar' => 'basic', 'media_upload' => 0, 'default_value' => '<p>Wondering <em>&ldquo;where can I get a private flu jab near me?&rdquo;</em> &mdash; you&rsquo;re in the right place. Southdowns Pharmacy Group offers private flu vaccinations across <strong>Emsworth, Havant, Leigh Park and Rowlands Castle</strong>.</p><p>Appointments are available at all of our pharmacy locations, and many slots can be booked same-day. Our flu vaccine private service is ideal for anyone who wants quick, dependable protection without the wait.</p>' ],

			[ 'key' => 'field_fv_tab_steps', 'label' => 'How It Works', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_steps_eyebrow', 'label' => 'Eyebrow', 'name' => 'fv_steps_eyebrow', 'type' => 'text', 'default_value' => 'Simple &amp; Quick' ],
			[ 'key' => 'field_fv_steps_heading', 'label' => 'Heading', 'name' => 'fv_steps_heading', 'type' => 'text', 'default_value' => 'Getting Your Flu Jab Is Easy' ],
			[ 'key' => 'field_fv_steps_intro', 'label' => 'Intro', 'name' => 'fv_steps_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'From booking to protected in three simple steps &mdash; no GP, no long waits.' ],
			[ 'key' => 'field_fv_steps', 'label' => 'Steps', 'name' => 'fv_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => [
				[ 'key' => 'field_fv_step_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail' ],
				[ 'key' => 'field_fv_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ],
				[ 'key' => 'field_fv_step_body', 'label' => 'Body', 'name' => 'body', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ],
			] ],

			[ 'key' => 'field_fv_tab_loc', 'label' => 'Locations', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_loc_heading', 'label' => 'Heading', 'name' => 'fv_loc_heading', 'type' => 'text', 'default_value' => 'Visit Your Nearest Flu Clinic' ],
			[ 'key' => 'field_fv_loc_intro', 'label' => 'Intro', 'name' => 'fv_loc_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'All four Southdowns Pharmacy locations offer NHS and private flu vaccinations. Same-day appointments usually available &mdash; call ahead to confirm.' ],
			[ 'key' => 'field_fv_loc_note_h', 'label' => 'Note Heading', 'name' => 'fv_loc_note_h', 'type' => 'text', 'default_value' => 'Not sure which branch to visit?' ],
			[ 'key' => 'field_fv_loc_note_b', 'label' => 'Note Body', 'name' => 'fv_loc_note_b', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Each of our four pharmacies books its own flu vaccination appointments. Find your nearest location above and contact that branch directly &mdash; every site offers both NHS and private flu jabs.' ],

			[ 'key' => 'field_fv_tab_cta', 'label' => 'Final CTA', 'name' => '', 'type' => 'tab' ],
			[ 'key' => 'field_fv_cta_eyebrow', 'label' => 'Eyebrow', 'name' => 'fv_cta_eyebrow', 'type' => 'text', 'default_value' => 'Same-Day Appointments Available' ],
			[ 'key' => 'field_fv_cta_heading', 'label' => 'Heading (HTML)', 'name' => 'fv_cta_heading', 'type' => 'text', 'default_value' => 'Book Your Flu<br/>Vaccination Today' ],
			[ 'key' => 'field_fv_cta_body', 'label' => 'Body', 'name' => 'fv_cta_body', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '', 'default_value' => 'Beat the seasonal rush. Book your private flu jab or NHS flu vaccination at any Southdowns Pharmacy &mdash; quick, convenient protection from Hampshire&rsquo;s trusted pharmacy group.' ],
			[ 'key' => 'field_fv_pills', 'label' => 'Badge Pills', 'name' => 'fv_pills', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Pill', 'sub_fields' => [ [ 'key' => 'field_fv_pill_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ] ] ],
			[ 'key' => 'field_fv_disclaimer', 'label' => 'Disclaimer', 'name' => 'fv_disclaimer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => '<strong>Medical disclaimer:</strong> The information on this page is for general guidance only and does not replace professional medical advice. NHS flu vaccine eligibility is set by the NHS and may change. Always consult a qualified healthcare professional about your individual circumstances. Southdowns Pharmacy pharmacists are registered with the General Pharmaceutical Council (GPhC).' ],
		],
	] );
} );

function fv_repeater_defaults(): array {
	return [
		'fv_stats' => [
			[ 'value' => '£20', 'label' => 'Private Flu Jab', 'caption' => 'Seasonal introductory offer' ],
			[ 'value' => 'Same Day', 'label' => 'Appointments', 'caption' => 'No GP referral needed' ],
			[ 'value' => 'Free', 'label' => 'NHS Vaccinations', 'caption' => 'For eligible patients' ],
			[ 'value' => '4', 'label' => 'Hampshire Locations', 'caption' => 'Book at your nearest branch' ],
		],
		'fv_eligible' => [
			[ 'title' => 'Aged 65 or over', 'body' => 'Everyone aged 65 and above qualifies for a free seasonal flu vaccination.' ],
			[ 'title' => 'Long-term health conditions', 'body' => 'Certain chronic conditions increase your risk — see the full list below.' ],
			[ 'title' => 'Pregnant at any stage', 'body' => 'Recommended during the first, second or third trimester of pregnancy.' ],
			[ 'title' => 'Living in a care home', 'body' => 'Residents of long-stay residential or care homes are eligible.' ],
			[ 'title' => 'Carers', 'body' => 'Main carers, or those receiving a carer&rsquo;s allowance, can be vaccinated free.' ],
			[ 'title' => 'Household contacts', 'body' => 'Living with someone who has a weakened immune system? You may qualify too.' ],
		],
		'fv_conditions' => [
			[ 'title' => 'Chronic respiratory disease', 'body' => 'Asthma requiring continuous or repeated use of inhaled or systemic steroids, or with previous exacerbations needing hospital admission. COPD including chronic bronchitis and emphysema; bronchiectasis, cystic fibrosis, interstitial lung fibrosis, pneumoconiosis and bronchopulmonary dysplasia (BPD). Children previously admitted to hospital for lower respiratory tract disease are also included.' ],
			[ 'title' => 'Chronic heart &amp; vascular disease', 'body' => 'Congenital heart disease, hypertension with cardiac complications, chronic heart failure, and anyone needing regular medication or follow-up for ischaemic heart disease. This also covers atrial fibrillation, peripheral vascular disease and a history of venous thromboembolism.' ],
			[ 'title' => 'Chronic kidney disease', 'body' => 'Chronic kidney disease at stage 3, 4 or 5, chronic kidney failure, nephrotic syndrome and kidney transplantation.' ],
			[ 'title' => 'Chronic neurological disease', 'body' => 'Stroke or transient ischaemic attack (TIA), and conditions where respiratory function may be compromised. Following individual assessment, immunisation is also offered to those with cerebral palsy, severe or profound multiple learning disabilities, Down&rsquo;s syndrome, multiple sclerosis, dementia, Parkinson&rsquo;s disease, motor neurone disease and related conditions.' ],
			[ 'title' => 'Diabetes &amp; adrenal insufficiency', 'body' => 'Type 1 diabetes, type 2 diabetes requiring insulin or oral hypoglycaemic drugs, and diet-controlled diabetes. Also Addison&rsquo;s disease and secondary or tertiary adrenal insufficiency requiring steroid replacement.' ],
			[ 'title' => 'Immunosuppression', 'body' => 'Weakened immune systems due to cancer treatment, organ or stem cell transplants, HIV, inherited immune disorders, or autoimmune diseases such as lupus, rheumatoid arthritis and psoriasis. These patients may respond less well to vaccination, making protection especially important.' ],
			[ 'title' => 'Morbid obesity (class III)', 'body' => 'Adults with a Body Mass Index of 40 kg/m² or above.' ],
			[ 'title' => 'Pregnancy', 'body' => 'Pregnant women at any stage of pregnancy — first, second or third trimester. The inactivated flu vaccine is safe and recommended in pregnancy.' ],
			[ 'title' => 'Household contacts of the immunosuppressed', 'body' => 'Those who share living accommodation on most days with someone who is immunosuppressed, where close contact is unavoidable.' ],
			[ 'title' => 'Carers', 'body' => 'Anyone eligible for a carer&rsquo;s allowance, or who is the sole or primary carer of an elderly or disabled person whose welfare may be at risk if the carer falls ill.' ],
		],
		'fv_priv_points' => [
			[ 'text' => 'Available to adults of all eligibilities' ], [ 'text' => 'Administered by a trained pharmacist' ], [ 'text' => 'Same-day &amp; walk-in appointments' ], [ 'text' => 'Protection against this year&rsquo;s flu strain' ],
		],
		'fv_steps' => [
			[ 'image' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=600&h=400&fit=crop', 'title' => 'Book or Walk In', 'body' => 'Book online or call your nearest branch. Same-day appointments are usually available, and we welcome walk-ins where possible.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=400&fit=crop', 'title' => 'Quick Eligibility Check', 'body' => 'Our pharmacist confirms whether you qualify for a free NHS jab or a private flu vaccination — it takes just a couple of minutes.' ],
			[ 'image' => 'https://images.unsplash.com/photo-1612277795421-9bc7706a4a34?w=600&h=400&fit=crop', 'title' => 'Vaccinated in Minutes', 'body' => 'Your flu jab is administered by a trained pharmacist. You&rsquo;re protected and back to your day in no time — no fuss, no long waits.' ],
		],
		'fv_pills' => [
			[ 'text' => 'GPhC Registered' ], [ 'text' => '4 Hampshire Locations' ], [ 'text' => 'Same-Day Appointments' ], [ 'text' => 'NHS &amp; Private Jabs' ], [ 'text' => '£20 Private Flu Jab' ],
		],
	];
}

add_action( 'acf/init', function () {
	foreach ( array_keys( fv_repeater_defaults() ) as $f ) {
		add_filter( "acf/load_value/name={$f}", function ( $value, $post_id, $field ) {
			if ( ! empty( $value ) ) return $value;
			$d = fv_repeater_defaults();
			return $d[ $field['name'] ] ?? $value;
		}, 10, 3 );
	}
} );
