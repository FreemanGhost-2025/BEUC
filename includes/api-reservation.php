<?php
add_action('rest_api_init', function() {
    register_rest_route('flash-reservation/v1', '/new', [
        'methods' => 'POST',
        'callback' => 'flash_create_reservation',
        'permission_callback' => '__return_true'
    ]);
});

function flash_create_reservation($request) {
    $data = $request->get_json_params();

    $post_id = wp_insert_post([
        'post_type' => 'reservation',
        'post_status' => 'publish',
        'post_title' => 'Réservation - ' . sanitize_text_field($data['nom']),
    ]);

    if ($post_id) {
        update_post_meta($post_id, 'nom', sanitize_text_field($data['nom']));
        update_post_meta($post_id, 'email', sanitize_email($data['email']));
        update_post_meta($post_id, 'telephone', sanitize_text_field($data['telephone']));
        update_post_meta($post_id, 'type', sanitize_text_field($data['type']));
        update_post_meta($post_id, 'element', sanitize_text_field($data['element']));
        update_post_meta($post_id, 'date', sanitize_text_field($data['date']));
        update_post_meta($post_id, 'places', intval($data['places']));

        return ['success' => true, 'message' => 'Réservation enregistrée avec succès !'];
    }

    return new WP_Error('error', 'Impossible d’enregistrer la réservation', ['status' => 500]);
}
