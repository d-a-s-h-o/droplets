import asyncio

async def test1():
    while True:
        print('test1')
        await asyncio.sleep(0.2)

async def test2():
    while True:
        print('\ntest2\n')
        await asyncio.sleep(3)

async def main():
    task1 = asyncio.create_task(test1())
    task2 = asyncio.create_task(test2())
    await asyncio.gather(task1, task2)

asyncio.run(main())