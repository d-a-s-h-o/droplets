import os
from dotenv import load_dotenv

load_dotenv()

class Config:

    ENV = os.getenv('FLASK_ENV', 'development')
    FLASK_DEBUG = os.getenv('FLASK_DEBUG', True)
    SECRET_KEY = os.getenv('APP_SECRET_KEY', 'dev')
    BASE_URL = os.getenv('APP_BASE_URL', '127.0.0.1')

    DATABASE_HOST = os.getenv('DB_HOST')
    DATABASE_PORT = os.getenv('DB_PORT')
    DATABASE_NAME = os.getenv('DB_NAME')
    DATABASE_USERNAME = os.getenv('DB_USERNAME')
    DATABASE_PASSWORD = os.getenv('DB_PASSWORD')
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    SQLALCHEMY_DATABASE_URI = 'postgres://{username}:{password}@{host}:{port}/{db_name}'.format(
        username=DATABASE_USERNAME,
        password=DATABASE_PASSWORD,
        host=DATABASE_HOST,
        port=DATABASE_PORT,
        db_name=DATABASE_NAME
    )
    SESSION_LENGTH = int(os.getenv('SESSION_LENGTH'))