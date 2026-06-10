@php
    $editorId = $id ?? 'trix_' . md5($name . '_' . uniqid());

    $oldKey = str_replace(['][', '[', ']'], ['.', '.', ''], $name);
    $editorValue = old($oldKey, $value ?? '');
@endphp

@once
    <style>
        .admin-trix-editor trix-toolbar {
            margin-bottom: 0.75rem;
        }

        .admin-trix-editor trix-toolbar .trix-button-row {
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .admin-trix-editor trix-toolbar .trix-button-group {
            margin: 0;
            border: 1px solid rgb(231 229 228);
            border-radius: 1rem;
            overflow: hidden;
            background: #ffffff;
        }

        .admin-trix-editor trix-toolbar .trix-button {
            border: 0;
            background: #ffffff;
            color: rgb(68 64 60);
            min-width: 2.35rem;
            height: 2.35rem;
        }

        .admin-trix-editor trix-toolbar .trix-button:hover {
            background: rgb(255 251 235);
        }

        .admin-trix-editor trix-toolbar .trix-button.trix-active {
            background: rgb(28 25 23);
            color: rgb(253 230 138);
        }

        .admin-trix-editor trix-toolbar .trix-button:disabled {
            opacity: 0.4;
        }

        .admin-trix-editor trix-toolbar .trix-dialog {
            border: 1px solid rgb(231 229 228);
            border-radius: 1rem;
            box-shadow: none;
            background: #ffffff;
        }

        .admin-trix-editor trix-toolbar .trix-input--dialog {
            border: 1px solid rgb(231 229 228);
            border-radius: 0.85rem;
            padding: 0.65rem 0.85rem;
            font-size: 0.875rem;
            font-weight: 600;
            outline: none;
        }

        .admin-trix-editor trix-toolbar .trix-input--dialog:focus {
            border-color: rgb(28 25 23);
            box-shadow: 0 0 0 4px rgb(254 243 199);
        }

        .admin-trix-editor trix-editor {
            min-height: 320px;
        }

        .admin-trix-editor .trix-content {
            width: 100%;
            min-height: 320px;
            border-radius: 1rem;
            border: 1px solid rgb(231 229 228);
            background: #ffffff;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1.75rem;
            color: rgb(68 64 60);
            outline: none;
            transition: all 150ms ease;
        }

        .admin-trix-editor .trix-content:focus {
            border-color: rgb(28 25 23);
            box-shadow: 0 0 0 4px rgb(254 243 199);
        }

        .admin-trix-editor .trix-content h1 {
            margin: 1rem 0 0.75rem;
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 2rem;
            color: rgb(28 25 23);
        }

        .admin-trix-editor .trix-content div {
            margin-bottom: 0.5rem;
        }

        .admin-trix-editor .trix-content blockquote {
            margin: 1rem 0;
            border-left: 4px solid rgb(120 113 108);
            padding-left: 1rem;
            color: rgb(87 83 78);
        }

        .admin-trix-editor .trix-content ul {
            margin: 0.75rem 0 0.75rem 1.5rem;
            list-style: disc;
        }

        .admin-trix-editor .trix-content ol {
            margin: 0.75rem 0 0.75rem 1.5rem;
            list-style: decimal;
        }

        .admin-trix-editor .trix-content li {
            margin: 0.35rem 0;
            padding-left: 0.25rem;
        }

        .admin-trix-editor .trix-content figure {
            margin: 1rem 0;
        }

        .admin-trix-editor .trix-content img {
            max-width: 100%;
            border-radius: 1rem;
        }
    </style>
@endonce

<div class="admin-trix-editor">
    <input id="{{ $editorId }}" type="hidden" name="{{ $name }}" value="{{ $editorValue }}">

    <trix-editor input="{{ $editorId }}" class="trix-content"></trix-editor>
</div>
