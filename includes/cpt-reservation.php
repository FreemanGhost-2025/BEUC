<?php
// Dans ton plugin Flash Reservation
add_action('init', function() {
    register_post_type('reservation', [
        'labels' => [
            'name' => 'Réservations',
            'singular_name' => 'Réservation',
            'menu_name' => 'Réservations',
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => ['title', 'custom-fields'],
    ]);
});
