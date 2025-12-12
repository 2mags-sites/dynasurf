<?php
/**
 * CTA (Call to Action) Component
 *
 * Include this in any page to display the standard CTA section.
 * Uses centralized config values for phone/WhatsApp.
 *
 * Options (set before including):
 *   $cta_embedded = true    - Skip section/container wrapper (for embedding in existing container)
 *   $cta_button_style       - Custom button styles (e.g., 'background: #e74c3c; border-color: #e74c3c;')
 */

$cta_embedded = $cta_embedded ?? false;
$cta_button_link = $content['cta']['button_link'] ?? '/contact.php';
$cta_button_style = $cta_button_style ?? '';

if (!$cta_embedded): ?>
<section class="section">
    <div class="container">
<?php endif; ?>
        <div class="cta-section"<?php echo $cta_embedded ? ' style="margin-top: 4rem;"' : ''; ?>>
            <h2><?php echo editable($content['cta']['title'] ?? 'Need Precision Engineering Services?', 'cta.title'); ?></h2>
            <p><?php echo editable($content['cta']['subtitle'] ?? 'Get a quote today for hydraulic repairs, cylinder honing, or precision engineering', 'cta.subtitle'); ?></p>
            <?php if (isset($content['cta']['emergency_note'])): ?>
                <p class="emergency-note" style="color: #e74c3c; font-weight: bold; margin: 1rem 0;">
                    <?php echo editable($content['cta']['emergency_note'], 'cta.emergency_note'); ?>
                </p>
            <?php endif; ?>

            <div class="cta-phones">
                <div class="phone-item">
                    <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', SITE_PHONE); ?>" style="color: inherit; text-decoration: none;">
                        📞 <?php echo SITE_PHONE; ?>
                    </a>
                </div>
                <div class="phone-item">
                    <a href="https://wa.me/<?php echo SITE_WHATSAPP_LINK; ?>" target="_blank" rel="noopener" style="color: inherit; text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#25D366" style="vertical-align: middle; margin-right: 5px;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <?php echo SITE_WHATSAPP; ?>
                    </a>
                </div>
            </div>
            <div>
                <a href="<?php echo htmlspecialchars($cta_button_link); ?>" class="btn btn-secondary"<?php echo $cta_button_style ? ' style="' . htmlspecialchars($cta_button_style) . '"' : ''; ?>>
                    <?php echo editable($content['cta']['button_text'] ?? 'Get Quote Now', 'cta.button_text'); ?>
                </a>
            </div>
        </div>
<?php if (!$cta_embedded): ?>
    </div>
</section>
<?php endif;
// Reset variables for next use
unset($cta_embedded, $cta_button_link, $cta_button_style);
?>
