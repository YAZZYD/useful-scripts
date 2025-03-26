import argparse
from yt_dlp import YoutubeDL

def download_playlist(url):
    ydl_opts = {
        'outtmpl': './Downloads/%(title)s.%(ext)s',
        'format': 'bv*+ba/best',  
        'merge_output_format': 'mp4',  
        'postprocessors': [{
            'key': 'FFmpegVideoConvertor',
            'preferedformat': 'mp4',  
        }]
    }
    with YoutubeDL(ydl_opts) as ydl:
        ydl.download([url])

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Download YouTube videos')
    parser.add_argument('url', help='URL of the video or playlist')
    args = parser.parse_args()
    
    download_playlist(args.url)
    print('All videos downloaded')
