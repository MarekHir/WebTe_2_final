FROM sail-8.2/app

COPY requirements.txt .

# Install additional dependencies
RUN apt-get update \
    && apt-get install -y python3-pip \
    && pip3 install -r requirements.txt
