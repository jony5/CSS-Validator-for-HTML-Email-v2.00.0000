<?php
$tmp_str = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAEt2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6dGlmZj0iaHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8iCiAgICB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMTkiCiAgIHRpZmY6SW1hZ2VXaWR0aD0iMTkiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIGV4aWY6UGl4ZWxYRGltZW5zaW9uPSIxOSIKICAgZXhpZjpQaXhlbFlEaW1lbnNpb249IjE5IgogICBleGlmOkNvbG9yU3BhY2U9IjEiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjEtMDMtMDFUMDI6Mzc6NTEtMDU6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjEtMDMtMDFUMDI6Mzc6NTEtMDU6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgUGhvdG8gKEZlYiAgMSAyMDIxKSIKICAgICAgc3RFdnQ6d2hlbj0iMjAyMS0wMy0wMVQwMjozNzo1MS0wNTowMCIvPgogICAgPC9yZGY6U2VxPgogICA8L3htcE1NOkhpc3Rvcnk+CiAgPC9yZGY6RGVzY3JpcHRpb24+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgo8P3hwYWNrZXQgZW5kPSJyIj8+DrCLGgAAAX9pQ0NQc1JHQiBJRUM2MTk2Ni0yLjEAACiRdZHPK0RRFMc/ZmjkRxQLymLSsDIa1MRGGQk1SWOUwWbmmh9qfrzee5Jsla2ixMavBX8BW2WtFJGSnbImNug5b54ayZzbPfdzv/ec073ngiuaVTmjMgC5vKlHRkPemdis1/OEmwo8tNAaV4Y2NDkZpqy930qs2LXfrlU+7l+rXUgaCiqqhQeVppvCY8LhZVOzeUu4WWXiC8Inwl26XFD4xtYTDj/bnHb402Y9GhkGV6OwN/2LE79YZfScsLwcXy67pH7uY7+kLpmfnpK1XWYbBhFGCeFlnBGGCdLDgPggfnrplh1l8gPF/AkKkqvEa6ygs0iaDCZdoi5J9aSsKdGTMrKs2P3/21cj1dfrVK8LQdWjZb12gGcTvjYs6+PAsr4Owf0A5/lSfmEf+t9E3yhpvj1oWIPTi5KW2IazdWi51+J6vCi5ZbpSKXg5hvoYNF1BzZzTs59zju4guipfdQk7u9Ap8Q3z3/lCZ7Q1amgkAAAACXBIWXMAAA7EAAAOxAGVKw4bAAACE0lEQVQ4jc2UQUiTYRjHf9/HkjlotZDSga3DBpIFCnVqggfNeeogeNWbMHYYCOXBm4J09aDocDcPCoFUh6F4iDlnzYFIssNXTsuNkbChbbja554O0WpOjQ2C/sfnhd/7f5//87zwPyhzkpGzNaVW2Fx0TrLfsnTZu2i92aoAGGoBre6uiveVl8Rxgs2DTbS0Jo4bDqVqmJbWxPvSS+wwhl7QCcfDnHw/AUCtFuaP+gnthtB1HZPBhNvppvlac/WwpdiSzEfmOdKPoADdjm767/djqbdU1/udLzvSOdMpjCA8Q+zP7RLcC5YlWubs4PhAUtlUReQAvoiPjY8bIGBWzbidbjrudJQ5KsHimbhMh6eZeTtDPBMvAy68X5DFyCJ5JQ869N7rpe9uX8WFpTSn3k3he+NDVVVyhRz7mX2xWWzKdmpb3C/cJHNJKELLrRY8jzzYLLaKPpVgscMY2XwWXdGZXZ/FaDAS+hQSf9RPeC8MKjQYGhhyDlU875dKxZUPKzK2PMba5zWKxSLW61bamtvYSmyRzCThFAYfDjLhmqDJ3HQ5DCCgBWR8eZz1/XWKdcXfBwVot7Yz+WTyQldwJk2Xw6WMPh7FeduJ4dRQAlnrrXicnktBFyqgBaRntkfUp6qYRkwy/HpYUl/PH5k/de5uuhwuJbgXFGOdEeMVIwMPBmi82ljzDwP8nD0trf3V0T/RD0ly2g+NSGMSAAAAAElFTkSuQmCC';