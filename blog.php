<?php
/**
 * Blog/News Listing Page
 * Pulls posts from WordPress at /news/ via REST API
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include admin configuration
require_once __DIR__ . '/includes/admin-config.php';
require_once __DIR__ . '/includes/blog-fetcher.php';

// Load page content
$content = loadContent('blog');

// Set page meta variables
$page_title = $content['meta']['title'] ?? 'News & Updates | Dynasurf UK Ltd';
$page_description = $content['meta']['description'] ?? 'Latest news and updates from Dynasurf UK Ltd - precision engineering specialists in hydraulic repairs, cylinder honing, and hose manufacturing.';
$page_keywords = $content['meta']['keywords'] ?? 'dynasurf news, precision engineering updates, hydraulic industry news';

// Get current page from URL
$current_page_num = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Fetch blog posts with pagination (9 per page)
$result = fetchBlogPostsPaginated($current_page_num, 9);
$blog_posts = $result['posts'];
$total_pages = $result['total_pages'];

// Include header
include __DIR__ . '/includes/header.php';
?>

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <h1><?php echo editable($content['hero']['title'] ?? 'News & Updates', 'hero.title'); ?></h1>
            <p class="lead"><?php echo editable($content['hero']['subtitle'] ?? 'Latest from Dynasurf UK Ltd', 'hero.subtitle'); ?></p>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog-section section">
        <div class="container">
            <?php if ($blog_posts && count($blog_posts) > 0): ?>
                <div class="blog-grid">
                    <?php foreach ($blog_posts as $post): ?>
                        <article class="blog-card">
                            <?php if ($post['featured_image']): ?>
                                <div class="blog-image">
                                    <a href="<?php echo $post['link']; ?>">
                                        <img src="<?php echo $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="blog-image blog-image-placeholder">
                                    <a href="<?php echo $post['link']; ?>">
                                        <div class="placeholder-icon">&#9881;</div>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="blog-content">
                                <div class="blog-date"><?php echo $post['date']; ?></div>
                                <h3><a href="<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a></h3>
                                <p><?php echo $post['excerpt']; ?></p>
                                <a href="<?php echo $post['link']; ?>" class="btn-link">Read More &rarr;</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php if ($total_pages > 1): ?>
                    <nav class="pagination">
                        <?php if ($current_page_num > 1): ?>
                            <a href="?page=<?php echo $current_page_num - 1; ?>" class="pagination-btn">&larr; Previous</a>
                        <?php endif; ?>

                        <div class="pagination-numbers">
                            <?php
                            // Always show first 2 pages
                            for ($i = 1; $i <= min(2, $total_pages); $i++):
                                if ($i == $current_page_num): ?>
                                    <span class="pagination-current"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-number"><?php echo $i; ?></a>
                                <?php endif;
                            endfor;

                            // Show ellipsis if there's a gap
                            if ($current_page_num > 4): ?>
                                <span class="pagination-ellipsis">...</span>
                            <?php endif;

                            // Show pages around current
                            $start = max(3, $current_page_num - 1);
                            $end = min($total_pages - 2, $current_page_num + 1);

                            for ($i = $start; $i <= $end; $i++):
                                if ($i == $current_page_num): ?>
                                    <span class="pagination-current"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-number"><?php echo $i; ?></a>
                                <?php endif;
                            endfor;

                            // Show ellipsis if there's a gap
                            if ($current_page_num < $total_pages - 3): ?>
                                <span class="pagination-ellipsis">...</span>
                            <?php endif;

                            // Always show last 2 pages
                            for ($i = max($total_pages - 1, 3); $i <= $total_pages; $i++):
                                if ($i == $current_page_num): ?>
                                    <span class="pagination-current"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-number"><?php echo $i; ?></a>
                                <?php endif;
                            endfor;
                            ?>
                        </div>

                        <?php if ($current_page_num < $total_pages): ?>
                            <a href="?page=<?php echo $current_page_num + 1; ?>" class="pagination-btn">Next &rarr;</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <div class="no-posts">
                    <div class="no-posts-icon">&#9881;</div>
                    <h2><?php echo editable($content['noPosts']['title'] ?? 'News Coming Soon', 'noPosts.title'); ?></h2>
                    <p><?php echo editable($content['noPosts']['message'] ?? 'We\'re preparing some exciting updates. Check back soon for the latest news from Dynasurf.', 'noPosts.message'); ?></p>
                    <a href="/" class="btn btn-primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <style>
        /* Page Hero - Matches service pages */
        .page-hero {
            padding: 6rem 0 4rem;
            text-align: center;
            background: linear-gradient(180deg, rgba(26, 29, 33, 0.5) 0%, var(--carbon-black) 100%);
            position: relative;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--laser-green), transparent);
            box-shadow: 0 0 10px rgba(169, 231, 2, 0.6);
        }

        .page-hero h1 {
            margin-bottom: 1rem;
        }

        .page-hero .lead {
            font-size: 1.25rem;
            color: var(--steel);
            letter-spacing: 0.05em;
        }

        /* Blog Section */
        .blog-section {
            padding: 4rem 0;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .blog-card {
            background: linear-gradient(135deg, rgba(26, 29, 33, 0.9), rgba(26, 29, 33, 0.7));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(201, 209, 217, 0.1);
            border-radius: var(--radius-md);
            overflow: hidden;
            transition: var(--transition);
        }

        .blog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--plasma-blue) 20%, var(--laser-green) 50%, var(--plasma-blue) 80%, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lifted);
            border-color: rgba(169, 231, 2, 0.2);
        }

        .blog-card:hover::before {
            opacity: 1;
        }

        .blog-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }

        .blog-image-placeholder {
            background: linear-gradient(135deg, var(--tungsten), var(--graphite));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-icon {
            font-size: 4rem;
            color: var(--titanium);
            opacity: 0.5;
        }

        .blog-content {
            padding: 1.5rem;
        }

        .blog-date {
            font-size: 0.85rem;
            color: var(--laser-green);
            margin-bottom: 0.75rem;
            letter-spacing: 0.05em;
        }

        .blog-content h3 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .blog-content h3 a {
            color: var(--chrome);
            text-decoration: none;
            transition: var(--transition);
        }

        .blog-content h3 a:hover {
            color: var(--laser-green);
        }

        .blog-content p {
            color: var(--steel);
            line-height: 1.7;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        /* No Posts */
        .no-posts {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, rgba(26, 29, 33, 0.6), rgba(26, 29, 33, 0.4));
            border-radius: var(--radius-lg);
            border: 1px solid rgba(201, 209, 217, 0.1);
        }

        .no-posts-icon {
            font-size: 4rem;
            color: var(--titanium);
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .no-posts h2 {
            margin-bottom: 1rem;
        }

        .no-posts p {
            max-width: 500px;
            margin: 0 auto 2rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 4rem;
            flex-wrap: wrap;
        }

        .pagination-btn {
            background: linear-gradient(135deg, var(--laser-green), #8BC400);
            color: var(--carbon-black);
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-pill);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(169, 231, 2, 0.3);
        }

        .pagination-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(169, 231, 2, 0.4);
            color: var(--carbon-black);
        }

        .pagination-numbers {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-number,
        .pagination-current,
        .pagination-ellipsis {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .pagination-number {
            background: rgba(26, 29, 33, 0.6);
            color: var(--aluminum);
            border: 1px solid rgba(201, 209, 217, 0.2);
        }

        .pagination-number:hover {
            border-color: var(--laser-green);
            color: var(--chrome);
            background: rgba(169, 231, 2, 0.1);
        }

        .pagination-current {
            background: var(--laser-green);
            color: var(--carbon-black);
            font-weight: 600;
            box-shadow: 0 0 15px rgba(169, 231, 2, 0.4);
        }

        .pagination-ellipsis {
            background: transparent;
            color: var(--steel);
            cursor: default;
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .page-hero {
                padding: 4rem 0 3rem;
            }

            .page-hero h1 {
                font-size: 2rem;
            }

            .pagination {
                gap: 0.75rem;
            }

            .pagination-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>

<?php include __DIR__ . '/includes/footer.php'; ?>
