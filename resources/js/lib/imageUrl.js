export function imageUrl(path) {
    if (!path) {
        return "/assets/images/placeholder.jpg";
    }

    // Already a complete URL
    if (path.startsWith("http://") || path.startsWith("https://")) {
        return path;
    }

    // Public assets
    if (path.startsWith("assets/")) {
        return `/${path}`;
    }

    // Uploaded files in Laravel storage
    return `/storage/${path.replace(/^\/+/, "")}`;
}