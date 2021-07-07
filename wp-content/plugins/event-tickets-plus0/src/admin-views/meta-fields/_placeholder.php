<?php
/**
 * Placeholder input for Admin view for fields with placeholder support.
 *
 * @since 5.2.5
 *
 * @version 5.2.5
 *
 * @var Tribe__Tickets_Plus__Meta__Field__Abstract_Field $field [Global] The field object.
 * @var int    $field_id  [Global] The ticket to add/edit.
 * @var string $placeholder [Global] The field placeholder.
 */

if ( ! $field->has_placeholder() ) {
	return;
}

$url     = 'https://theeventscalendar.com/knowledgebase/k/collecting-attendee-information-for-tickets-and-rsvp/';
$kb_link = sprintf( __( '<a href="%s" target="_blank" rel="noopener noreferrer">Learn More</a>', 'event-tickets-plus' ), $url );
?>
<div class="tribe-tickets-input tribe-tickets-input-text">
	<label for="tickets_attendee_info_field">
		<?php echo esc_html_x( 'Placeholder:', 'Attendee information fields', 'event-tickets-plus' ); ?>
	</label>
	<input
		type="text"
		class="ticket_field"
		name="tribe-tickets-input[<?php echo esc_attr( $field_id ); ?>][placeholder]"
		value="<?php echo esc_attr( $placeholder ); ?>"
	>
	<p>
		<?php echo wp_kses_post( sprintf( __( 'The placeholder field specifies a short hint that describes the expected value of the input. %s', 'event-tickets-plus' ), $kb_link ) ); ?>
	</p>
</div>