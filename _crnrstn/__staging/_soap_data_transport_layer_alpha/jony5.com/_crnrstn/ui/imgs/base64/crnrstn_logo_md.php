<?php
$tmp_str = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKUAAABkCAYAAADnn/DLAAAEtWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjE2NSIKICAgZXhpZjpQaXhlbFlEaW1lbnNpb249IjEwMCIKICAgZXhpZjpDb2xvclNwYWNlPSI2NTUzNSIKICAgdGlmZjpJbWFnZVdpZHRoPSIxNjUiCiAgIHRpZmY6SW1hZ2VMZW5ndGg9IjEwMCIKICAgdGlmZjpSZXNvbHV0aW9uVW5pdD0iMiIKICAgdGlmZjpYUmVzb2x1dGlvbj0iOTYuMCIKICAgdGlmZjpZUmVzb2x1dGlvbj0iOTYuMCIKICAgcGhvdG9zaG9wOkNvbG9yTW9kZT0iMyIKICAgcGhvdG9zaG9wOklDQ1Byb2ZpbGU9IkRpc3BsYXkiCiAgIHhtcDpNb2RpZnlEYXRlPSIyMDIxLTAzLTAx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';