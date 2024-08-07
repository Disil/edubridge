
    function getDominantColors(image, callback) {
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.src = image.src;
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            context.drawImage(img, 0, 0, img.width, img.height);
            const data = context.getImageData(0, 0, img.width, img.height).data;
            const colors = {};
            for (let i = 0; i < data.length; i += 4) {
                const color = `${data[i]},${data[i + 1]},${data[i + 2]}`;
                colors[color] = (colors[color] || 0) + 1;
            }
            const sortedColors = Object.keys(colors).sort((a, b) => colors[b] - colors[a]);
            callback(sortedColors.slice(0, 2).map(color => `rgb(${color})`));
        };
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.card img').forEach(img => {
            getDominantColors(img, colors => {
                const card = img.closest('.card');
                card.style.setProperty('--color1', colors[0]);
                card.style.setProperty('--color2', colors[1]);
            });
        });
    });