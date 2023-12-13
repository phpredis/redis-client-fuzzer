# Redis Client Fuzzer

### Project to help fuzz test PHP Redis clients that support PhpRedis' API.

```bash
# Exclude DEL and EXISTS for now since they will have cross-slot errors
php src/fuzz.php --exclude del,exists
```
