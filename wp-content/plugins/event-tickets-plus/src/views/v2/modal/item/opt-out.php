<?php
/**
 * Block: Tickets
 * Form Opt-Out
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets-plus/v2/modal/item/opt-out.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link https://evnt.is/1amp
 *
 * @since 5.1.0
 *
 * @version 5.1.0
 *
 * @var bool $is_modal True if it's in modal context.
 */

// Bail if it's not in modal context.
if ( empty( $is_modal ) ) {
	return;
}

/**
 * Use this filter to hide the Attendees List Opt-out.
 *
 * @since 4.9
 *
 * @param bool
 */
$hide_attendee_list_optout = apply_filters( 'tribe_tickets_plus_hide_attendees_list_optout', false );

if ( $hide_attendee_list_optout ) {
	// Force opt-out.
	?>
	<input
		name="attendee[optout]"
		value="1"
		type="hidden"
	/>
	<?php
	return;
}
?>

<input
	id="tribe-tickets-attendees-list-optout-modal-<?php echo esc_attr( $ticket->ID ); ?>"
	class="tribe-tickets__tickets-item-quantity"
	name="attendee[optout]"
	value="1"
	type="hidden"
/>
