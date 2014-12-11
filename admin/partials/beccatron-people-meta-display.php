<?php

/**
 * Render the metabox
 *
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/admin/partials
 */
?>
<?php

	/** Create the field array
	 *
	 */
	 
	// Field Array
	$prefix = 'personmeta_';
	$person_meta_fields = array(
		
		// Short Bio 
		array(
			'label'=>  'Short Bio',
			'desc'	=> '50 words or less',
			'id'	=> $prefix.'shortbio',
			'type'	=> 'textarea'
		),
		
		// Email 
		array(
			'label'=> 'Email',
			'desc'	=> 'Email address.',
			'id'	=> $prefix.'email',
			'type'	=> 'text'
		),
		
		// Website 
		array(
			'label'=> 'Website',
			'desc'	=> 'Homepage URL.',
			'id'	=> $prefix.'website',
			'type'	=> 'text'
		),
		
		// Twitter
		array(
			'label'=> 'Twitter',
			'desc'	=> 'Twitter URL.',
			'id'	=> $prefix.'twitter',
			'type'	=> 'text'
		),
		
		// Primary Institional Affiliation
		array(
			'label'=> 'Institutional Affiliation (Primary)',
			'desc'	=> 'Business/Organization/University.',
			'id'	=> $prefix.'inst1',
			'type'	=> 'text'
		),
		
		array(
			'label'=>  'Position (Primary)',
			'desc'	=> 'Position/role/title within Institution.',
			'id'	=> $prefix.'role1',
			'type'	=> 'text'
		),
		
		// Secondary Institional Affiliation
		array(
			'label'=> 'Institutional Affiliation (Secondary)',
			'desc'	=> 'Business/Organization/University.',
			'id'	=> $prefix.'inst2',
			'type'	=> 'text'
		),
		
		array(
			'label'=>  'Position (Secondary)',
			'desc'	=> 'Position/role/title within Institution.',
			'id'	=> $prefix.'role2',
			'type'	=> 'text'
		),
		
		/* array(
			'label'=> 'Checkbox Input',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'checkbox',
			'type'	=> 'checkbox'
		),
		array(
			'label'=> 'Select Box',
			'desc'	=> 'A description for the field.',
			'id'	=> $prefix.'select',
			'type'	=> 'select',
			'options' => array (
				'one' => array (
					'label' => 'Option One',
					'value'	=> 'one'
				),
				'two' => array (
					'label' => 'Option Two',
					'value'	=> 'two'
				),
				'three' => array (
					'label' => 'Option Three',
					'value'	=> 'three'
				)
			)
		)*/
	);
?>

<h1> HELLO WORLD </h1>
<div id="vital-stats">  
	<?php 
		
		wp_nonce_field( basename( __FILE__ ), 'person_nonce' );
		$person_stored_meta = get_post_meta( get_the_ID() ); 
		
	?>	
  
     <p>
        <label for="person-email" class="person-email">Email<label>
       <input type="text" name="person-email" class="person-email" value="<?php echo esc_attr( get_post_meta( $object->ID, 'smashing_post_class', true ) ); ?>" />
    </p>
    
    <p>
        <label for="person-website" class="person-website">Website<label>
        <input type="text" name="person-website" class="person-website" value="<?php echo $person_stored_meta['person-website'][0]; ?>" />
    </p>
    
     <p>
        <label for="person-twitter" class="person-twitter">Twitter<label>
        <input type="text" name="person-twitter" class="person-twitter" value="<?php echo $person_stored_meta['person-twitter'][0]; ?>" />
    </p>
    
  

</div>

