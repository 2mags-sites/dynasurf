<?php
/**
 * Single Blog Post Page
 * Displays individual post from WordPress via REST API
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include admin configuration
require_once __DIR__ . '/includes/admin-config.php';
require_once __DIR__ . '/includes/blog-fetcher.php';

// Get post slug from URL
$post_slug = $_GET['slug'] ?? '';

if (empty($post_slug)) {
    header('Location: /blog/');
    exit;
}

// Fetch the post from WordPress API
$post = fetchBlogPostBySlug($post_slug);

if (!$post) {
    header('Location: /blog/');
    exit;
}

// Set page meta from post
$page_title = html_entity_decode($post['title']) . ' | Dynasurf UK Ltd';
$page_description = substr(strip_tags($post['excerpt']), 0, 160);
$page_keywords = 'dynasurf news, precision engineering';

// Include header
include __DIR__ . '/includes/header.php';
?>

    <!-- Post Hero -->
    <section class="post-hero">
        <?php if ($post['featured_image']): ?>
            <div class="post-hero-image" style="background-image: url('<?php echo $post['featured_image']; ?>');"></div>
        <?php else: ?>
            <div class="post-hero-image post-hero-gradient"></div>
        <?php endif; ?>
        <div class="post-hero-overlay"></div>
    </section>

    <!-- Post Content -->
    <article class="post-article section">
        <div class="container">
            <div class="post-wrapper">
                <header class="post-header">
                    <div class="post-meta">
                        <span class="post-date"><?php echo $post['date']; ?></span>
                    </div>
                    <h1><?php echo $post['title']; ?></h1>
                </header>

                <div class="post-content">
                    <?php echo $post['content']; ?>
                </div>

                <footer class="post-footer">
                    <a href="/blog/" class="btn btn-secondary">&larr; Back to All News</a>
                </footer>
            </div>
        </div>
    </article>

    <!-- CTA Section -->
    <?php include __DIR__ . '/includes/cta.php'; ?>

    <style>
        /* Post Hero */
        .post-hero {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .post-hero-image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .post-hero-gradient {
            background: linear-gradient(135deg, var(--tungsten) 0%, var(--graphite) 50%, var(--carbon-black) 100%);
        }

        .post-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                transparent 0%,
                rgba(11, 14, 16, 0.3) 50%,
                var(--carbon-black) 100%);
        }

        /* Post Article */
        .post-article {
            padding: 0 0 4rem;
            margin-top: -80px;
            position: relative;
            z-index: 10;
        }

        .post-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Post Header */
        .post-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(201, 209, 217, 0.1);
        }

        .post-meta {
            margin-bottom: 1.5rem;
        }

        .post-date {
            display: inline-block;
            background: linear-gradient(135deg, var(--laser-green), #8BC400);
            color: var(--carbon-black);
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-pill);
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.03em;
        }

        .post-header h1 {
            font-size: 2.5rem;
            line-height: 1.3;
            margin: 0;
        }

        /* Post Content */
        .post-content {
            background: linear-gradient(135deg, rgba(26, 29, 33, 0.8), rgba(26, 29, 33, 0.6));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(201, 209, 217, 0.1);
            border-radius: var(--radius-lg);
            padding: 3rem;
            line-height: 1.9;
            color: var(--aluminum);
        }

        .post-content h2 {
            color: var(--chrome);
            font-size: 1.75rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(169, 231, 2, 0.2);
        }

        .post-content h3 {
            color: var(--chrome);
            font-size: 1.4rem;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }

        .post-content h4 {
            color: var(--aluminum);
            font-size: 1.15rem;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .post-content p {
            margin-bottom: 1.5rem;
            color: var(--steel);
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius-md);
            margin: 2rem 0;
            box-shadow: var(--shadow-floating);
        }

        .post-content ul,
        .post-content ol {
            margin: 1.5rem 0;
            padding-left: 1.5rem;
        }

        .post-content li {
            margin-bottom: 0.75rem;
            color: var(--steel);
        }

        .post-content li::marker {
            color: var(--laser-green);
        }

        .post-content a {
            color: var(--laser-green);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .post-content a:hover {
            color: var(--plasma-blue);
        }

        .post-content blockquote {
            border-left: 3px solid var(--laser-green);
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background: rgba(169, 231, 2, 0.05);
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
            font-style: italic;
            color: var(--aluminum);
        }

        .post-content pre,
        .post-content code {
            background: var(--graphite);
            border-radius: var(--radius-sm);
            font-family: 'Consolas', 'Monaco', monospace;
        }

        .post-content code {
            padding: 0.2rem 0.5rem;
            font-size: 0.9em;
            color: var(--laser-green);
        }

        .post-content pre {
            padding: 1.5rem;
            overflow-x: auto;
            margin: 1.5rem 0;
        }

        .post-content pre code {
            padding: 0;
            background: transparent;
        }

        /* Post Footer */
        .post-footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(201, 209, 217, 0.1);
        }

        @media (max-width: 768px) {
            .post-hero {
                height: 250px;
            }

            .post-article {
                margin-top: -50px;
            }

            .post-header h1 {
                font-size: 1.75rem;
            }

            .post-content {
                padding: 1.5rem;
            }

            .post-content h2 {
                font-size: 1.4rem;
            }

            .post-content h3 {
                font-size: 1.2rem;
            }
        }
    </style>

<?php include __DIR__ . '/includes/footer.php'; ?>
