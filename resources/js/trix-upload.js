document.addEventListener('trix-attachment-add', function (event) {
    const attachment = event.attachment;

    if (!attachment.file) {
        return;
    }

    uploadTrixAttachment(attachment);
});

function uploadTrixAttachment(attachment) {
    const uploadUrl = document.querySelector('meta[name="trix-upload-url"]')?.getAttribute('content');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!uploadUrl || !csrfToken) {
        return;
    }

    const file = attachment.file;
    const formData = new FormData();

    formData.append('attachment', file);

    const xhr = new XMLHttpRequest();

    xhr.open('POST', uploadUrl, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    xhr.setRequestHeader('Accept', 'application/json');

    xhr.upload.addEventListener('progress', function (event) {
        if (event.lengthComputable) {
            const progress = Math.round((event.loaded / event.total) * 100);
            attachment.setUploadProgress(progress);
        }
    });

    xhr.addEventListener('load', function () {
        if (xhr.status < 200 || xhr.status >= 300) {
            return;
        }

        const response = JSON.parse(xhr.responseText);

        attachment.setAttributes({
            url: response.url,
            href: response.url,
        });
    });

    xhr.send(formData);
}